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
            require_once 'PHPGangsta/GoogleAuthenticator.php';
        ?>
        <section>
            <?php
                $success = true;
                $error_msg = "";

                $code = $_POST["user_input"];
                debug_to_console('dawdawd');
                debug_to_console($code);
                

                /* Check if the username entry is empty */
                if(empty($code)) {
                   $error_msg .= "<li class='list-group-item'>2FA code is required</li>";
                   $success = false;
                }
           
                else {
                    twofa($code);
                }
                
                if($success) {
                    
                    $config = parse_ini_file("../../private/db-config.ini");
                    $link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
                   
                    require 'Zebra_Session.php';
                    $session = new Zebra_Session($link, 'sEcUr1tY_c0dE');

                    // Session
                    
                    
                    
                    $_SESSION["name"] = 'nq9dnwqnd9qi2n3ed03ed92n!@#!90e209#@40u0!';
                    header('Location: https://34.145.96.82/ICT1004/admin.php');
                    
                   // echo "<form class='container p-3' action='index.php'>"
                  //     . "<h1 class='display-4'>Welcome back, " . $_SESSION["name"] . "</h1>"
                    //   . "<button class='btn btn-outline-dark' type='submit'>Home</button>"
                    //   . "</form>";
                      
                }
                else {
                    echo "<form class='container p-3' action='admintwofa.php'>"
                       . "<h1 class='display-4'>Oops!</h1>"
                       . "<p class='lead'>The following errors were detected:</p>"
                       . "<ul class='list-group list-group-flush pb-5'>"
                       . $error_msg 
                       . "</ul>"
                       . "<button class='btn btn-outline-dark' type='submit'>Return to Login</button>"
                       . "</form>";
                }

                /* Helper function to check 2FA code */
                function twofa($code) {

                    global $code, $success, $error_msg;

                    /* Check 2FA */
                    $secret = 'Y6SKMCT633IF4VCW';
                    $checkResult = $ga->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance
                        if ($checkResult) {
                            echo 'OK';
                        }
                        else
                        {
                            $error_msg .= "<li class='list-group-item'>2FA code did not match!</li>";
                            $success = false;
                        }
                        
                    }
                  
                
                
                
            ?>
        </section>
    </body>
</html>