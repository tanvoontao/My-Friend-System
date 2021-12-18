<?php
class User {
    // ---------- fields ---------- //
    private $email;
    private $name;
    private $password;
    private $profile_img;
    private $number_of_friends;
    private $user_id;

    // ---------- constructor ---------- //
    public function __construct($post_data, $profileImg){
        $this->email = $post_data['user_email'];
        $this->name = $post_data['profile_name'];
        $this->password = $post_data['password'];
        $this->profile_img = $profileImg;
        $this->number_of_friends = 0;
    }


    // ---------- Properties ---------- //
    public function GetEmail(){
        return $this->escapeString($this->email);
    }
    public function GetName(){
        return $this->escapeString($this->name);
    }
    public function GetPassword(){
        return hash('sha256', $this->escapeString($this->password) );
    }
    public function GetProfileImg(){
        return $this->profile_img;
    }
    public function GetNumberOfFriends(){
        return $this->number_of_friends;
    }
    public function SetNumberOfFriends($no){
        $this->number_of_friends = $no;
    }
    public function GetUserId(){
        return $this->user_id;
    }
    public function SetUserId($id){
        $this->user_id = $id;
    }


    // ---------- Methods ---------- //
    private function escapeString($data){
        $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);
        $data = mysqli_real_escape_String($conn, UserValidator::val($data));
        $conn->close();
        return $data;
    }
    
    public function UpdateNoOfFriends(){
        $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);
        $query = "SELECT num_of_friends FROM ".TABLE_USERS." WHERE user_email = '$this->email'";
        $results = $conn->query($query);
        
        $this->number_of_friends = $results->fetch_assoc()['num_of_friends'];
        return $this->number_of_friends;
    }
}
?>