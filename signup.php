<?php

require('classes/UserValidator.php');
require('classes/User.php');
require('classes/SocialCircle.php');
require('classes/DatabasesAndTables.php');

$errors = [];
$error_msg = "";
$user_email = "";
$profile_name = "";
$allGood = false;

session_start();


if(isset($_POST['register_btn'])){
    // validate input data
    $validation = new UserValidator($_POST, $_FILES);
    $errors = $validation->validateForm();
    if (empty($errors)){ // if errors is empty --> save data to database

        $user = new User($_POST, $_FILES); // create user obj
        $socialCircle = new SocialCircle(); //create social circle
        $allGood = $socialCircle->AddUser($user); // insert user data

        if($allGood){
            $results = UserValidator::isUserExist( UserValidator::val($_POST['user_email']) )[1];
            $rows = $results->fetch_assoc();
            $user = new User($rows, $rows['profile_img']);
            $user->SetNumberOfFriends($rows['num_of_friends']);
            $user->SetUserId($rows['user_id']);
            $_SESSION['user'] = serialize($user);
            header("Location: friendadd.php");
        }
        
    }else{
        $error_msg .= "<h2 class=error my-1'>Error</h2>";

        foreach($errors as $error => $error_value){
            $error_msg .= "<p class='error'>$error_value</p>";
        }

        $user_email = $_POST['user_email'];
        $profile_name = $_POST['profile_name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!---------- Head Tag Template ---------->
<?php include("functions/headTag.php"); ?>

<body>
<div class="container-fluid big_container">

    <!---------- Register Form ---------->
    <div class="px-3">
        <h1>My Social Circle</h1>
        
        <form action="signup.php" method="post" enctype="multipart/form-data" class="signUp_form p-3 my-2">
            <h2>Sign Up <br/> <span class="small_txt">It's quick and easy. </span></h2>
            <hr/>
            
            <div class='row m-0 p-0'>
                <div class="col-md-4 m-0 p-1">

                    <!---------- Profile Image Area ---------->
                    <div class="upload_profile_area my-2">

                        <!---------- Upload profile img area ---------->
                        <div class="icon"><i class='bx bx-cloud-upload'></i></div>
                        <p class="dragText">Click to upload your profile</p>
                    </div>

                    <!---------- Profile Img ---------->
                    <input type="file" id="profile_img" name="profile_img"  class="image_input"  />

                </div>
                <div class="col-md-8 m-0 p-1">
                    <!---------- Regiser Login Email ---------->
                    <input type="text" name="user_email" value='<?php echo $user_email; ?>' placeholder="Your email..." class="p-3 my-2">

                    <!---------- Register Profile Name ---------->
                    <input type="text" name="profile_name" value='<?php echo $profile_name; ?>' placeholder="Your profile name..." class="p-3 my-2">
                </div>
            </div>
            

            <div class="row m-0 p-0">
                <!---------- Register Password ---------->
                <input type="password" name="password" placeholder="Your password..." class="col-md p-3 my-2 mx-1">

                <!---------- Register confirm password ---------->
                <input type="password" name="confirm_password" placeholder="Your confirm password..." class="col-md p-3 my-2 mx-1">
            </div>

            <!---------- Form Clear and Register btn ---------->
            <div class="form_btn mt-3">
                <button type="reset" class="cancel_btn">Clear</button>
                <button type="submit" id="submit_btn" name="register_btn">Register</button>
            </div>

        </form>
    </div>


    <!---------- Message box to generate success/failure of register ---------->
    <div class="px-3">
        <div class="box error_bx p-3 my-2">
            <img src="images/top_image.png" alt="register" class="register_img">

            <?php echo $error_msg; ?>

            <div class="btns">
                <a class="link_button m-2" href="index.php">Home</a>
            </div>
            
        </div>
    </div>

</div>
<script src="javascript/function.js"></script>
</body>
</html>