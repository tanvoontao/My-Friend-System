<?php
session_start();
if(isset($_SESSION['user'])){ // if session is set, destroy it
    session_unset();
    session_destroy();
}
?>