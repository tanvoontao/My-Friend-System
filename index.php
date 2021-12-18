<?php
require('classes/DatabasesAndTables.php');

require("functions/destroy_session.php");

$msg = "";
$allGood = true;

$conn = @new mysqli("localhost", "root", "", "");
if($conn->connect_error){
    die(
        "<p class='error'>
            Unable to connect to the database server. <br/>
            Error code $conn->connect_errno: $conn->connect_error
        </p>"
    );
}


// create database social_db if not exist
@$conn->query("CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME)
or $msg .= "<p class='error'>Unable to create database ".DATABASE_NAME.". </p>" and $allGood = false;


// select_db -> change the default database for the connection
@$conn->select_db(DATABASE_NAME) 
or $msg .= "<p class='error'>Unable to select database ".DATABASE_NAME.". <br/> Error code $conn->connect_errno: $conn->connect_error </p>" and $allGood = false;

// create table users if not exist
$query = "CREATE TABLE IF NOT EXISTS ".TABLE_USERS."(
    user_id int(4) NOT NULL AUTO_INCREMENT,
    user_email varchar(50) NOT NULL,
    password varchar(20) NOT NULL,
    profile_name varchar(30) NOT NULL,
    date_started date NOT NULL,
    num_of_friends int unsigned,
    profile_img varchar(255) NOT NULL,
    PRIMARY KEY  (user_id)
)";

@$conn->query($query) or $msg .= "<p class='error'> Unable to create the table ".TABLE_USERS.". </p> " and $allGood = false;

// although the page will refresh multiple times, but due to user_id is primary key, the record won't duplicate
@$conn->query("LOAD DATA LOCAL INFILE 'data/".USERS_TXT."' INTO TABLE ".TABLE_USERS." fields terminated by ','") 
or $msg .= "<p class='error'> Unable to populate the users ".USERS_TXT." sample records. </p>" and $allGood = false;


$query = "CREATE TABLE IF NOT EXISTS ".TABLE_MYFRIENDS."(
    user_id int(4) NOT NULL,
    friend_id int(4) NOT NULL
) ";
    
@$conn->query($query) or $msg .= "<p class='error'> Unable to create the table ".TABLE_MYFRIENDS.". </p>" and $allGood = false;

// only if the there is no record (also means newly created table) -> load the sample records
if( $conn->query("SELECT * FROM ".TABLE_MYFRIENDS)->num_rows == 0 ){
    @$conn->query("LOAD DATA LOCAL INFILE 'data/".MYFRIENDS_TXT."' INTO TABLE ".TABLE_MYFRIENDS." fields terminated by ','") 
    or $msg .= "<p class='error'> Unable to populate the ".MYFRIENDS_TXT." sample records. </p>" and $allGood = false;
}

// if there are no error generated --> print the success msg
if($allGood){
    $msg .= "<p>Database ".DATABASE_NAME." created successfully. </p>
            <p>Tables created successfully. </p>
            <p>Tables populated successfully.</p>";
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<!---------- Head Tag Template ---------->
<?php include("functions/headTag.php"); ?>

<body>
    <div class="container-fluid big_container">

        <!---------- Assignment declaration and necessary personal information ---------->
        <div class="px-3">
            <h1>My Social Circle</h1>

            <div class="chat_area my-3">
                <img src="images/profile.jpeg" alt="profile" class="profile"/>
                <div class="chat_box left mx-2 p-3">
                    <p>
                        Halo!! 👋 My name is <span class="purple_txt"><strong>Tan Voon Tao</strong></span>.
                        My student ID is <span class="purple_txt"><strong>101234693</strong></span>.
                        This is my email address: <span class="purple_txt"><strong><a href="mailto:101234693@students.swinburne.edu.my">101234693@students.swinburne.edu.my</a></strong></span>
                    </p>
                </div>
            </div>

            <div class="chat_area my-3">
                <div class="chat_box right mx-2 p-3">
                    <p>
                        I declare that this assignment is my individual work. I have not work collaboratively 
                        nor have I copied from any other student's work or from any other source. I have not 
                        engaged another party to complete this assignment. I am aware of the University’s policy 
                        with regards to plagiarism. I have not allowed, and will not allow, anyone to copy my 
                        work with the intention of passing it off as his or her own work.
                    </p>
                </div>
                <img src="images/profile.jpeg" alt="profile" class="profile"/>

            </div>

            <div class="chat_area my-3">
                <img src="images/profile.jpeg" alt="profile" class="profile"/>
                <div class="chat_box left mx-2 p-3">
                    <p>
                        Alright! 👍 Great! It's time to GO! Let's start your journal! 🔥
                    </p>
                </div>
            </div>
        </div>

        <!---------- Message to indicate the failure/success of creating database,tables,and population of sample records ---------->
        <div class="px-3">
            <div class="box p-3 my-2">
                <h2>Messages</h2>
                <?php echo $msg; ?>
                <div class="btns">
                    <a class="link_button m-2" href="signup.php">Sign Up</a>
                    <a class="link_button m-2" href="login.php">Login</a>
                    <a class="link_button m-2" href="about.php">About</a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>