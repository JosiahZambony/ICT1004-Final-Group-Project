<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="De Jun">
        <meta name="author" content="Kar Hoe">
        <meta name="author" content="Tham Josiah">
        <meta name="author" content="Xiang Xi">
        
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity=
                "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
        <script defer
                src="https://code.jquery.com/jquery-3.4.1.min.js"
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                crossorigin="anonymous">
        </script>
        <script defer
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
                crossorigin="anonymous">
        </script>
        
        <title>Login</title>
    </head>
    <body>
        <?php
        function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
            include "nav_bar.php";
        ?>
        <section>
            <?php
                $success = true;
                $error_msg = "";

                $username = $_POST["user_input"];
                $pwd = $_POST["pwd_input"];

                /* Check if the username entry is empty */
                if(empty($username)) {
                   $error_msg .= "<li class='list-group-item'>Username entry is required</li>";
                   $success = false;
                }
                /* Check if the password entry is empty */
               
                
                if(empty($pwd)) {
                   $error_msg .= "<li class='list-group-item'>Password entry is required</li>";
                   $success = false;
                }
                else {
                    authenticate_user($pwd);
                }
                
                if($success) {
                    
                    $config = parse_ini_file("../../private/db-config.ini");
                    $link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
                   
                    require 'Zebra_Session.php';
                    $session = new Zebra_Session($link, 'sEcUr1tY_c0dE');

                    // Session
                    
                    $_SESSION["name"] = 'nq9dnwqnd9qi2n3ed03ed92n!@#!90e209#@40u0!';
                    header('Location: http://34.145.96.82/ICT1004/admin.php');
                    
                   // echo "<form class='container p-3' action='index.php'>"
                  //     . "<h1 class='display-4'>Welcome back, " . $_SESSION["name"] . "</h1>"
                    //   . "<button class='btn btn-outline-dark' type='submit'>Home</button>"
                    //   . "</form>";
                      
                }
                else {
                    echo "<form class='container p-3' action='adminlogin.php'>"
                       . "<h1 class='display-4'>Oops!</h1>"
                       . "<p class='lead'>The following input errors were detected:</p>"
                       . "<ul class='list-group list-group-flush pb-5'>"
                       . $error_msg 
                       . "</ul>"
                       . "<button class='btn btn-outline-dark' type='submit'>Return to Login</button>"
                       . "</form>";
                }

                /* Helper function to write the member data to the DB */
                function authenticate_user($pwd_data) {

                    global $username, $success, $error_msg;

                    /* Create database connection */
                    $config = parse_ini_file("../../private/db-config.ini");
                    $conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
                    
                    /* Check connection */
                    if($conn->connect_error) {
                        
                        $error_msg .= "Connection issue is found";
                        $success = false;
                    }
                    else {
                         // Prepare the statement
                        $stmt = $conn->prepare("SELECT * FROM admin_login WHERE admin_username=?");
                          
                        // Bind & Execute the query statement:
                        $stmt->bind_param("s", $username);
                        
                        $stmt->execute();
                        
                        debug_to_console($username);
                        $result = $stmt->get_result();
                        if($result->num_rows > 0)
                        {
                            
                            $row = $result->fetch_assoc();
                            $hashed_pwd = $row["admin_password"];
                            // Check if the password matches:
                            
                            if(!password_verify($pwd_data, $hashed_pwd))
                            
                            
                            {
                                
                                // Don't be too specific with the error message - hackers don't
                                // need to know which one they got right or wrong. :)
                                $error_msg .= "<li class='list-group-item'>Username not found or Password doesn't match...</li>";
                                $success = false;
                            }
                        }
                        else
                        {
                            $error_msg .= "<li class='list-group-item'>Username not found or password doesn't match...</li>";
                            $success = false;
                        }
                        $stmt->close();
                    }
                    $conn->close();
                }
                
                
                
            ?>
        </section>
    </body>
</html>