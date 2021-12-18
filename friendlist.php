<?php
require('classes/UserValidator.php');
require('classes/User.php');
require('classes/SocialCircle.php');
require('classes/DatabasesAndTables.php');

require("functions/auth_session.php");

$user = unserialize($_SESSION['user']);

// get the user details, ltr use in display the profile name, profile img, pofile email, no of friends
// user_id is help to checked the mutual friends number from current friend AND unfriend link 
$user_name = $user->GetName();
$user_email = $user->GetEmail();
$user_profile_img = $user->GetProfileImg();
$user_no_of_friends = $user->UpdateNoOfFriends();
$user_id = $user->GetUserId();

$socialCircle = new SocialCircle(); //create social circle
$results = $socialCircle->CheckMutualFriendsFromFriends($user_id);

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

            <!---------- friendadd.php link ---------->
            <p class='add_friend_link'> <a href="friendadd.php"> 🤼 Wanna more friends? Click me! </a> </p>
        </div>
    </div>
    

    <div class='m-3 p-3 profile_box'>
        <!---------- Number of friends ---------->
        <h2>You have <?php echo $user_no_of_friends; ?> friends</h2>
        
        <?php
            $count = 0; 
            if($results){
                while($rows = $results->fetch_assoc()){ 
                    $count ++;
                    if($count % 2 != 0){ echo "<div class='row'>"; }
            
            
        ?>
            <div class='col-md p-2 m-2 friend_box'>

                <!---------- Friend profile img ---------->
                <img src="UserProfileImage/<?php echo $rows['profile_img']; ?>" alt="profile"/>
                
                <!---------- Friend profile name and its Number of mutual friends from curr friend ---------->
                <p>
                    <?php echo $rows['profile_name']; ?> <br/>
                    <span><?php echo $rows['mutual_friends']; ?> mutual friends</span>
                </p>

                <!---------- Unfriend button ---------->
                <p class='unfriend_btn'>
                    <a class="link_button" href="functions/delete.php?user_id=<?php echo $user_id; ?>&friend_id=<?php echo $rows['user_id']; ?>">
                        <i class='bx bxs-user-x'></i>
                        Unfriend
                    </a>
                </p>
            </div>
            
        <?php if($count % 2 == 0){echo "</div>";} } } ?>
    </div>
    </div>
</body>
</html>