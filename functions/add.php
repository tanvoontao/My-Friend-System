<?php
require("auth_session.php");
require('../classes/SocialCircle.php');
require('../classes/DatabasesAndTables.php');

$user_id = $_GET['user_id'];
$friend_id = $_GET['friend_id'];

$socialCircle = new SocialCircle(); 

$results = $socialCircle->AddFriend($user_id, $friend_id);
header("Location: ../friendadd.php?latestAddedUser=".$friend_id);


?>