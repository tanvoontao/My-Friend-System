<!DOCTYPE html>
<html lang="en">

<!---------- Head Tag Template ---------->
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
    <div class="btns">
                    <a class="link_button m-2" href="signup.php">Sign Up</a>
                    <a class="link_button m-2" href="login.php">Login</a>
                    <a class="link_button m-2" href="index.php">Home</a>
                </div>
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col p-3 m-2 purple_bg">
                    <p class="dark_red big">What tasks have you not attempted or not completed?</p>
                    <div class="table-responsive-md">
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Task</th>
                                <th scope="col">Description</th>
                                <th scope="col">Degree of Completion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">Home Page</strong> (index.php)</p>
                                    <ul>
                                        <li>Page contains information shown in screenshot</li>
                                        <li>Links are working and using relative addressing</li>
                                        <li>Database tables created</li>
                                        <li>Records successful added</li>
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️ Declaration stetement, name, student id, email address, profile image</p>
                                    <p>✔️ All links are using relative addressing</p>
                                    <p>✔️ Database, tables, population of sample records successfull using <strong class="orange_word"> PHP OOP</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">Sign Up Page</strong> (signup.php)</p>
                                    <ul>
                                        <li>Form contains all information shown in screenshot</li>
                                        <li>Web page using the POST method</li>
                                        <li>Input data validated and added into database table</li>
                                        <li>Session variables successfully created</li>
                                        <li>Appropriate error messages generated if errors occur</li>
                                        <li>Links are working and using relative addressing</li>
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️ Form submission using POST Method and all information included</p>
                                    <p>✔️ ⭐ Input data validation under <strong class="orange_word">classes/UserValidator.php</strong> and will return erros </p>
                                    <p>✔️ ⭐ Create User object using <strong class="orange_word">classes/User.php</strong> and add into table using <strong class="orange_word">classes/SocialCircle.php start from line 11</strong> </p>
                                    <p>✔️ Set session</p>
                                    <p>✔️ Display error in the message box</p>
                                    <p>✔️ Links are working and using relative addressing</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">Log In Page</strong> (login.php)</p>
                                    <ul>
                                        <li>Form contains all information shown in screenshot</li>
                                        <li>Web page using the POST method</li>
                                        <li>Input data validated and checked against records in database table</li>
                                        <li>Session variables successfully created</li>
                                        <li>Appropriate error messages generated if errors occur</li>
                                        <li>Links are working and using relative addressing</li>
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️ Form submission using POST Method and all information included</p>
                                    <p>✔️ ⭐ Input data validation and checked against records under <strong class="orange_word">classes/UserValidator.php</strong> using <strong class="orange_word">isEmailOk(), isLoginPasswordOk() and isUserExist()</strong> and will return erros </p>
                                    
                                    <p>✔️ Set session</p>
                                    <p>✔️ Display error in the message box</p>
                                    <p>✔️ Links are working and using relative addressing</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">4</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">List Friend Page</strong> (friendlist.php)</p>
                                    <ul>
                                        <li>Page contains information similar to screenshot</li>
                                        <li>Unfriend button works</li>
                                        <li>Total number of friends updated</li>
                                        <li>Links are working and using relative addressing</li>
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️ Page contain information</p>
                                    <p>✔️ ⭐ Unfriend button works under <strong class="orange_word">functions/delete.php</strong> using <strong class="orange_word">DeleteFriend() in classess/SocialCircle.php</strong>  </p>
                                    <p>✔️ ⭐ Total number of friends updated under <strong class="orange_word">functions/delete.php</strong> using <strong class="orange_word">DeleteFriend(), UpdateNumOfFriends() in classess/SocialCircle.php</strong></p>
                                    <p>✔️ Links are working and using relative addressing</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">5</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">Add Friend Page</strong> (friendadd.php)</p>
                                    <ul>
                                        <li>Page contains information similar to screenshot</li>
                                        <li>Add button works</li>
                                        <li>Total number of friends updated</li>
                                        <li>Links are working and using relative addressing</li>
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️ Page contain information</p>
                                    <p>✔️ ⭐ Add button works under <strong class="orange_word">functions/add.php</strong> using <strong class="orange_word">AddFriend() in classess/SocialCircle.php</strong>  </p>
                                    <p>✔️ ⭐ Total number of friends updated under <strong class="orange_word">functions/add.php</strong> using <strong class="orange_word">AddFriend(), UpdateNumOfFriends() in classess/SocialCircle.php</strong></p>
                                    <p>✔️ Links are working and using relative addressing</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">6</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">Log out Page</strong> (logout.php)</p>
                                    <ul>
                                        <li>Clears all session variables</li>
                                        <li>Redirect to home page</li>
                                        
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️ Clears all session variables</p>
                                    <p>✔️ ⭐ Redirect to home page HERE a bit difference from requirements above, so I add a link to Home Page</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">7</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">About Page</strong> (about.php)</p>
                                    <ul>
                                        <li>All questions answered</li>
                                        <li>Links are working and using relative addressing</li>
                                        
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️ All questions answered</p>
                                    <p>✔️ Links are working and using relative addressing</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">8</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">Pagination</strong> (friendadd.php)</p>
                                    <ul>
                                        <li>Enable pagination in Add Friend Page (friendadd.php)</li>
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️⭐ Can get it in about line 52</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">9</th>
                                <td>
                                    <p class="dark_red midle"><strong class="orange_word">Mutual Friend Count</strong> (friendadd.php)</p>
                                    <ul>
                                        <li>Enable pagination in Add Friend Page (friendadd.php)</li>
                                    </ul>
                                </td>
                                <td>
                                    <p>✔️⭐ Can get it in about line 29</p>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>

                    <p class="dark_red big">What special features have you done, or attempted, when creating the site? </p>
                    <div class="table-responsive-md">
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Extra feature</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">File upload - User Profile (signup.php)</th>

                                <td>
                                    <p>✔️ File type validation</p>
                                    <p>✔️ upload image to folder: UserProfileImage/</p>
                                    <p>✔️ unique image name generated</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Anouther Mutual Friend Count (friendlist.php)</th>
                                <td>
                                    <p>✔️ This will be the most complicated one. The Mysql query can be found under <strong class='orange_word'>classes/SocialCircle() line 59</strong>
                                        (Requirements one is mutual friend count from non-friend, this is from friend)</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Responsive/fluid layout</th>
                                <td>
                                    <p>✔️ Using bootstrap 4</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Object Oriented Programing</th>
                                <td>
                                    <p>✔️ Using PHP OOP to handle the coding will be more easire to manage in the future</p>
                                </td>
                            </tr>

                        </tbody>
                        </table>
                    </div>


                    <p class="dark_red big">Which parts did you have trouble with?  </p>
                    <div class="table-responsive-md">
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Trouble</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Mutual Friend Count from non-friend (friendadd.php)</th>

                                <td>
                                    <p>Using single mysql to achieve it is pretty hard, 
                                        need to refer online resources to test the database 
                                        again and again to understand the logic behind</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Mutual Friend Count from friend (friendlist.php)</th>
                                <td>
                                    <p>Although sounds similar to the requirements 
                                        but the Mysql query used is different from that,
                                        thus it used more time to research and refer the online resources.</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Forbidden of load data function</th>
                                <td>
                                    <p>Forbidden of load data function seems by default. I need to go to php.ini to enable this function in order to use in this assignment.</p>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>



                    <p class="dark_red big">What would you like to do better next time?  </p>
                    <div class="table-responsive-md">
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Wishing</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Better object oriented style</th>

                                <td>
                                    <p>I should study more about Object Oriented way to program a reusable code. 
                                        For example, the UserValidator class is the most satisfied class that I wrote. </p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">MVC (Model–view–controller) </th>
                                <td>
                                    <p>This is the best assignment which can practice my MVC principal, 
                                        I think I haven't arrange its optimized way, thus I think I wish to do it better next time.</p>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>



                    <p class="dark_red big">What additional features did you add to the assignment?  </p>
                    <div class="table-responsive-md">
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Extra feature</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Enable File upload - User Profile (signup.php)</th>

                                <td>
                                    <p>✔️ File type validation</p>
                                    <p>✔️ upload image to folder: UserProfileImage/</p>
                                    <p>✔️ unique image name generated</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Anouther Mutual Friend Count (friendlist.php)</th>
                                <td>
                                    <p>✔️ This will be the most complicated one. The Mysql query can be found under <strong class='orange_word'>classes/SocialCircle() line 59</strong>
                                        (Requirements one is mutual friend count from non-friend, this is from friend)</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Responsive/fluid layout</th>
                                <td>
                                    <p>✔️ Using bootstrap 4</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Object Oriented Programing</th>
                                <td>
                                    <p>✔️ Using PHP OOP to handle the coding will be more easire to manage in the future</p>
                                </td>
                            </tr>

                        </tbody>
                        </table>
                    </div>
            </div>
        </div>

    </div>

    

        
</body>
</html>