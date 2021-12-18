<?php
require('classes/UserValidator.php');
require('classes/User.php');
require('classes/SocialCircle.php');
require('classes/DatabasesAndTables.php');

require("functions/auth_session.php");

$user = unserialize($_SESSION['user']);


$page = ( isset($_GET['page']) ) ? $_GET['page'] : 1;

$num_per_page = 5;
$start_from = ($page-1)*$num_per_page;



// get the user details, ltr use in display the profile name, profile img, pofile email, no of friends
// user_id is help to checked the mutual friends number from non-friend AND add friend link
$user_name = $user->GetName();
$user_email = $user->GetEmail();
$user_profile_img = $user->GetProfileImg();
$user_no_of_friends = $user->UpdateNoOfFriends();
$user_id = $user->GetUserId();

// query for check mutual friends
$query = 
"SELECT 
    u.profile_name,
    u.user_id,
    u.profile_img,
    COUNT(DISTINCT mf2.user_id) AS mutual_friends
FROM users AS u

LEFT JOIN myfriends AS mf1 
ON (mf1.user_id = u.user_id)

LEFT JOIN myfriends AS mf2
ON (IFNULL (mf1.friend_id, -1) = mf2.user_id AND mf2.friend_id = '$user_id' )

WHERE
    u.user_id <> '$user_id' AND 
    u.user_id NOT IN (SELECT friend_id FROM myfriends WHERE user_id = '$user_id') GROUP BY u.user_id
ORDER BY
    u.profile_name ";


$socialCircle = new SocialCircle(); //create social circle

// limit here is used for pagination, for example: LIMIT 0,5 -> display first 5 records
$results = $socialCircle->CheckMutualFriendsFromNewUser( $query . "LIMIT $start_from,$num_per_page" );

// get the total records and calculate how many pages we need for pagination
$total_records = ($socialCircle->CheckMutualFriendsFromNewUser($query))->num_rows;
$total_page = ceil($total_records/$num_per_page);


$friend = "";
if(isset($_GET['latestAddedUser'])){
    // get the new added friend name based on the friend_id
    $friend = $_GET['latestAddedUser'];
    $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);
    $query = "SELECT profile_name FROM users WHERE user_id = '$friend'";
    $friend = $conn -> query($query);
    $rows = $friend->fetch_assoc();
    $friend = "<h3> <strong>".$rows['profile_name']."</strong> is now your friend! </h3>";
}


$_SESSION['user'] = serialize($user);
?>

<!DOCTYPE html>
<html lang="en">
<?php include("functions/headTag.php"); ?>
<body>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col">
                <h1>Welcome to My Social Circle System! 👋</h1>
            </div>
        </div>
        <hr/>
    </div>

    

    <div class="container-fluid">
        <div class='m-3 p-3 profile_box'>
            <div class='profile_container'>

                <!---------- Profile Img ---------->
                <img src="UserProfileImage/<?php echo $user_profile_img; ?>" alt="profile"/>

                <!---------- Profile name and email ---------->
                <p>
                    <?php echo $user_name; ?> <br/>
                    <span><?php echo $user_email; ?></span>
                </p>

                <!---------- Logout button ---------->
                <p class='logout_btn'> <a href="logout.php"><i class='bx bx-log-out'></i></a></p>

                <!---------- friendlist.php link ---------->
                <p class='add_friend_link'> <a href="friendlist.php"> 🧑‍🤝‍🧑 Wanna view your friends? Click me! </a> </p>
            </div>
        </div>

        <div class='m-3 p-3 profile_box'>
            <!---------- Number of friends ---------->
            <h2>You have <?php echo $user_no_of_friends; ?> friends</h2>

            <!---------- Newly added friend name ---------->
            <?php echo $friend; ?>
            
            <?php
                $count = 0; 
                $no_row = $results->num_rows;
                if($results){
                    while($rows = $results->fetch_assoc()){ 
                        $no_row--;
                        $count ++;
                        if($count % 2 != 0){ echo "<div class='row'>"; }
                
                
            ?>
                <div class='col-md p-2 m-2 friend_box'>

                    <!---------- Friend profile img ---------->
                    <img src="UserProfileImage/<?php echo $rows['profile_img']; ?>" alt="profile"/>
                    
                    <!---------- Friend profile name and its Number of mutual friends from non-friend ---------->
                    <p>
                        <?php echo $rows['profile_name']; ?> <br/>
                        <span><?php echo $rows['mutual_friends']; ?> mutual friends</span>
                    </p>

                    <!---------- Addfriend button ---------->
                    <p class='add_friend_btn'>
                        <a class="link_button" href="functions/add.php?user_id=<?php echo $user_id; ?>&friend_id=<?php echo $rows['user_id']; ?>">
                            <i class='bx bxs-user-plus'></i>
                            Add Friend
                        </a>
                    </p>
                </div>
                
            <?php if($count % 2 == 0 || $no_row == 0){echo "</div>";} } } ?>
            
            
        </div>
    </div>

    <div class='pagination'>
        <?php
            // if it's not the page --> display previous link
            if($page > 1){
                echo "<a href='friendadd.php?page=".($page-1)."' class='m-2 p-1'><i class='bx bxs-left-arrow'></i></a>";
            }
                    
            for($i=1; $i<=$total_page; $i++){
                echo "<a class='m-2 p-1 ";
                if($i == $page){
                    echo "active";
                }
                echo "' href='friendadd.php?page=$i'>$i</a>";
            }
            
            // if it's not the last page -> display next link
            if($i-1 > $page){
                echo "<a href='friendadd.php?page=".($page+1)."' class='m-2 p-1'><i class='bx bxs-right-arrow' ></i></a>";
            }

        ?>
    </div>
</body>
</html>