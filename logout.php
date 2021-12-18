<?php
require("functions/destroy_session.php");
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

    

    <div class="container-fluid login_page">
        <img src="images/login.PNG" alt="login" class='login_img'>
        <div class="btns">
            <a class="link_button m-2" href="signup.php">Sign Up</a>
            <a class="link_button m-2" href="login.php">Login</a>
            <a class="link_button m-2" href="index.php">Home</a>
        </div>
    </div>
</body>
</html>