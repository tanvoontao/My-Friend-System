<?php

class SocialCircle {
    // ---------- constructor ---------- //
    public function __construct(){
        $this->users = array();
    }


    // ---------- methods ---------- //
    public function AddUser($user){

        // get details from user
        $user_email = $user->GetEmail();
        $user_password = $user->GetPassword();
        $user_name = $user->GetName();
        $date_started = date('Y-m-d');
        $num_of_friends = $user->GetNumberOfFriends();

        $userProfile = $user->GetProfileImg();
        $tmp_name = $userProfile['profile_img']['tmp_name']; // get the temperature name which ltr use to upload into folder called: userProfile

        // get new img name using time thus it will not have repeated img name inside folder while storing
        $new_img_name = time() . $userProfile['profile_img']['name']; 

        // upload image to this directory: "UserProfileImage/ followed by the new img name"
        move_uploaded_file($tmp_name,"UserProfileImage/".$new_img_name); 


        // preprared statement to avoid MySql injection risk
        $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);
        $query = "INSERT INTO ".TABLE_USERS." 
                (user_email, password, profile_name, date_started, num_of_friends, profile_img) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $prepared_stmt = $conn->prepare($query);
        $prepared_stmt->bind_param("ssssis", $user_email, $user_password, $user_name, $date_started, $num_of_friends, $new_img_name);
        

        $prepared_stmt->execute();
        $results = $prepared_stmt->get_result();
        $prepared_stmt->close();
        $conn->close();

        /* according https://www.php.net/manual/en/mysqli-stmt.get-result.php :
        failure -> return false
        for successful queries which create result set: SELECT, SHOW, DESCRIBE or EXPLAIN -> return result obj
        for other successfull queries -> return false */

        if(!$results){
            return true;
        }
        return false;
    }

    public function CheckMutualFriendsFromFriends($user_id){ // check the mutual friends number from currect friends in 'friendlist.php'
        $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);

        $query = 
        "SELECT u.user_id, u.profile_name, u.profile_img, COUNT(f3.friend_id) mutual_friends
        FROM ".TABLE_MYFRIENDS." f1
        INNER JOIN ".TABLE_MYFRIENDS." f2 ON f2.user_id = f1.friend_id
        INNER JOIN ".TABLE_USERS." u ON u.user_id = f2.user_id
        LEFT JOIN ".TABLE_MYFRIENDS." f3 ON f3.user_id = f1.user_id AND f3.friend_id = f2.friend_id
        WHERE f1.user_id = '$user_id'
        GROUP BY u.user_id, u.profile_name
        ORDER BY u.profile_name
        ";
        $results = $conn -> query($query);
        $conn->close();

        if( $results->num_rows > 0){
            return $results;
        }
    }

    public function CheckMutualFriendsFromNewUser($query){ 
        // check the mutual friends number from non-friend in 'friendadd.php' by using the query parameter pass in
        $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);
        $results = $conn -> query($query);
        $conn->close();
        if( $results->num_rows > 0){
            return $results;
        }
    }

    public function DeleteFriend($user_id, $friend_id){
        $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);

        // delete two records from myfriends table, for example: delete (1,2) should also delete (2,1)
        $query = 
        "DELETE FROM  ".TABLE_MYFRIENDS." 
        WHERE (user_id, friend_id)
        IN ( ('$user_id', '$friend_id') , ('$friend_id', '$user_id') )";

        $results = $conn -> query($query);
        $results = $this->UpdateNumOfFriends($conn, $user_id);
        $results = $this->UpdateNumOfFriends($conn, $friend_id);
        $conn->close();
        return $results;
    }

    public function AddFriend($user_id, $friend_id){
        $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);

        // add friends into myfriends tables: for example: add (1,2) should also add (2,1)
        $query = 
        "INSERT INTO ".TABLE_MYFRIENDS." (user_id, friend_id)
        VALUES
            ('$user_id', '$friend_id'),
            ('$friend_id', '$user_id') ";
        $results = $conn -> query($query);

        $results = $this->UpdateNumOfFriends($conn, $user_id);
        $results = $this->UpdateNumOfFriends($conn, $friend_id);
        $conn->close();
        return $results;
    }

    public function UpdateNumOfFriends($conn, $user_id){
        // update the num_friends from users table by counting the Number of occurrences of the same user_id
        $query = 
        "UPDATE ".TABLE_USERS."
        SET num_of_friends = (SELECT COUNT(user_id) FROM myfriends WHERE user_id = '$user_id')
        WHERE user_id = '$user_id' ";

        $results = $conn->query($query);
        
        return $results;
    }

    
}

?>