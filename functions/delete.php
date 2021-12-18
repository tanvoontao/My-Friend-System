<?php
require("auth_session.php");
require('../classes/SocialCircle.php');
require('../classes/DatabasesAndTables.php');

$user_id = $_GET['user_id'];
$friend_id = $_GET['friend_id'];

$socialCircle = new SocialCircle(); //create social circle

$results = $socialCircle->DeleteFriend($user_id, $friend_id);
header("Location: ../friendlist.php");

?>