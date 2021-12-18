<?php

$titles = array(
    array("index.php", "Home Page"),
    array("friendadd.php", "Friend Add"),
    array("friendlist.php", "Friend List"),
    array("login.php", "Login"),
    array("logout.php", "Logout"),
    array("signup.php", "Sign Up"),
    array("about.php", "About Assignment")
);


echo '
<head>
    <title>';
    foreach($titles as $title){
        $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
        $url = end($url_array); 
        $url = strtok($url, '?');
        if($title[0] == $url){
            echo "$title[1]";
            break;
        }
    }
    echo '</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Tan Voon Tao"/>
    <meta name="copyright" content="Tan Voon Tao" />
    <meta name="keywords" content="Assignment2"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Assignment2">

    <!-- Jquery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- CSS Styling -->
    <link rel="stylesheet" type="text/css" href="styles/style.css"/>
    
    <!-- Icon cdn -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    
</head>
';

?>