<?php
require('classes/UserValidator.php');
require('classes/User.php');
require('classes/SocialCircle.php');
require('classes/DatabasesAndTables.php');


$errors = [];
$error_msg = $user_email = "";
$allGood = false;

session_start();

if(isset($_POST['login_btn'])){
    // validate input data
    $validation = new UserValidator($_POST, $_FILES);

    // errors store in associative array
    $errors = $validation->validateForm();

    if(empty($errors)){
        // return results based on the user_login_email to find the user
        $results = UserValidator::isUserExist( UserValidator::val($_POST['user_login_email']) )[1];
        $rows = $results->fetch_assoc();

        // create user object
        $user = new User($rows, $rows['profile_img']);
        $user->SetNumberOfFriends($rows['num_of_friends']);
        $user->SetUserId($rows['user_id']);

        // set a session and redirect to 'friendlist.php'
        $_SESSION['user'] = serialize($user);
        header("Location: friendlist.php");

    }else{
        // found errors --> display it
        $error_msg .= "<h2 class=error my-1'>Error</h2>";

        foreach($errors as $error => $error_value){
            $error_msg .= "<p class='error'>$error_value</p>";
        }

        $user_email = $_POST['user_login_email'];
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<!---------- Head Tag Template ---------->
<?php include("functions/headTag.php"); ?>

<body>

<div class="container-fluid big_container">

    <!---------- Login Form ---------->
    <div class="px-3">
        <h1>My Social Circle</h1>
        <form action="login.php" method="post" class="signUp_form p-3 my-2">
            <h2>Login <br/> <span class="small_txt">Long time no see. </span></h2>

            <hr/>
            
            <!---------- Login User Email ---------->
            <input type="text" name="user_login_email" value='<?php echo $user_email; ?>' placeholder="Your email..." class="p-3 my-2">

            <!---------- Login User Password ---------->
            <input type="password" name="login_password" placeholder="Your password..." class="p-3 my-2">

            <!---------- Form Clear and Login btn ---------->
            <div class="form_btn mt-3">
                <button type="reset" class="cancel_btn">Clear</button>
                <button type="submit" id="submit_btn" name="login_btn">Login</button>
            </div>
        </form>
    </div>


            
    <!---------- Message box to generate success/failure of login ---------->
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
</body>
</html>