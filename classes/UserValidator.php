<?php
class UserValidator {
    // ---------- fields ---------- //
    private $data; 
    private $files;
    private $errors = []; // error: associative array 

    
    // ---------- constructor ---------- //
    public function __construct($post_data, $file_data){
        $this->data = $post_data; // all $_POST variable: associative array
        $this->files = $file_data; // all $_FILES variable: associative array
    }

    
    // ---------- methods ---------- //
    public function validateForm(){ // validate all form input value
        $this->isEmailOk();
        $this->isNameOk();
        $this->isPasswordOk();
        $this->isProfileOk();
        $this->isLoginPasswordOk();
        return $this->errors;
    }

    public static function val($eData){ // remove backslash, strim the data
        $eData = trim($eData);
        $eData = stripslashes($eData);
        $eData = htmlspecialchars($eData);
        return $eData;
    }

    private function addError($key, $val){ // add error to the associative array
        $this->errors[$key] = $val;
    }

    private function isNameOk(){

        if(isset($this->data['profile_name'])){
            $val = $this->val($this->data['profile_name']); // remove unnecessary symbols

            if(empty($val)){
                $this->addError('profile_name', '<strong>Profile name</strong>:  cannot be empty');
            }else{
                if(!preg_match('/^[a-zA-Z ]{0,25}$/', $val)){
                    $this->addError('profile_name','<strong>Profile name</strong>: can only alphabets, whitespace, and 25 characters allowed');
                }
            }
        }
    }


    private function isEmailOk(){ // need to check its uniqueness 
        
        if(isset($this->data['user_email'])){
            $val = $this->val($this->data['user_email']); // remove unnecessary symbols
        }else if(isset($this->data['user_login_email'])){
            $val = $this->val($this->data['user_login_email']);
        }

        if(isset($val)){

            if(empty($val)){
                $this->addError('user_email', '<strong>Email</strong>: cannot be empty');
            }else{
                if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                    $this->addError('user_email', '<strong>Email</strong>: Invalid email address');
                }
            }


            // if the it's register email and the account exist
            if( isset($this->data['user_email']) && ($this->isUserExist($val))[0] ){
                $this->addError('user_email', 'You have an existing account ! ');
            }
            
        }
    }

    public static function isUserExist($user_email){
        $result1 = array();

        $conn = @new mysqli("localhost", "root", "", DATABASE_NAME);
        $query = "SELECT * FROM ".TABLE_USERS." WHERE user_email=?";
        $prepared_stmt = $conn->prepare($query);
        $prepared_stmt->bind_param("s", $user_email);
        $prepared_stmt->execute();
        $results = $prepared_stmt->get_result();
        $prepared_stmt->close();
        $conn->close();
        
        if($results->num_rows != 0){ // if the account exist
            array_push( $result1, true );
        }else{
            array_push( $result1, false );
        }
        array_push( $result1, $results );

        return $result1;

    }

    private function isPasswordOk(){
        if(isset($this->data['password'])){
            $val = $this->val($this->data['password']); // remove unnecessary symbols
            $confirm_val = $this->val($this->data['confirm_password']); // remove unnecessary symbols

            $number = preg_match('@[0-9]@', $val);
            $uppercase = preg_match('@[A-Z]@', $val);
            $lowercase = preg_match('@[a-z]@', $val);
            
            if(empty($val)){
                $this->addError('password', '<strong>Password</strong>: Your Password cannot be empty! ');
            }else if( strlen($val)<8 ){
                $this->addError('password', '<strong>Password</strong>: Your Password Must Contain At Least 8 Characters! ');
            }else if(!$number){
                $this->addError('password', '<strong>Password</strong>: Your Password Must Contain At Least 1 Number! ');
            }else if(!$uppercase){
                $this->addError('password', '<strong>Password</strong>: Your Password Must Contain At Least 1 Capital Letter! ');
            }else if(!$lowercase){
                $this->addError('password', '<strong>Password</strong>: Your Password Must Contain At Least 1 Lowercase Letter! ');
            }else if(empty($confirm_val)){
                $this->addError('confirm_password', '<strong>Password</strong>: Your Confirm Password cannot be empty! ');
            }else if($val != $confirm_val){
                $this->addError('confirm_password', '<strong>Confirm Password</strong>: Both passwords do not match! ');
                $this->addError('password', '<strong>Password</strong>: Both passwords do not match.! ');
            }
        }
    }


    private function isProfileOk(){
        if(isset($this->files['profile_img'])){
            $extension = ["jpeg", "jpg", "png"]; // valid img ext 
            $val = $this->files['profile_img']; // get img extension 
            $val = strtolower(pathinfo($_FILES["profile_img"]['name'],PATHINFO_EXTENSION));

            if(empty($val)){
                $this->addError('profile_img', '<strong>Profile Image</strong>: Cannot be empty');
            }else{
                if(in_array($val, $extension) === false){ // if not a valid img type
                    $this->addError('profile_img', '<strong>Profile Image</strong>: Invalid Image extension (jpeg, png, jpg). ');
                }
            }
        }
    }

    private function isLoginPasswordOk(){
        if(isset($this->data['login_password'])){
            $user_email = $this->val($this->data['user_login_email']);
            $user_password = $this->val($this->data['login_password']);

            if(empty($user_password)){
                $this->addError('password', '<strong>Password</strong>: Cannot be empty. ');
            }else{
                if( $this->isUserExist($user_email)[0]){
                    $results = $this->isUserExist($user_email)[1];
                    $rows = $results->fetch_assoc();
                    
                    // due to requirement of varchar(20) for password, therefore after encrypte, we only get the first 20 to store ltr
                    if( substr( hash('sha256', $user_password) , 0,20)  != $rows['password']){
                        $this->addError('password', '<strong>Password</strong>: Incorrect. ');
                    }
                }
            }
        }
    }
}
?>
