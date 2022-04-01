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
        
        <title>Register</title>
    </head>
    <body>
        <?php
            include "nav_bar.php";
        ?>
        <section>
            <?php
                $success = true;
                $error_msg = "";
                $hashed_pwd = "";

                $username = filter_input(INPUT_POST, "user_input");
                $email = filter_input(INPUT_POST, "email_input");
                $pwd = filter_input(INPUT_POST, "pwd_input");
                $pwd_confirm = filter_input(INPUT_POST, "pwd_confirm");

                /* Check if the username entry is empty */
                if(empty($username)) {
                   $error_msg .= "<li class='list-group-item'>Username entry is required</li>";
                   $success = false;
                }
                /* Check if the email entry is empty */
                if(empty($email)) {
                   $error_msg .= "<li class='list-group-item'>Email entry is required</li>";
                   $success = false;
                }
                /* Additional check to make sure e-mail address is well-formed */
                $email = sanitise_input($email);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error_msg .= "<li class='list-group-item'>Invalid email format</li>";
                    $success = false;
                }
                /* Check if the password entry is empty */
                if(empty($pwd)) {
                   $error_msg .= "<li class='list-group-item'>Password entry is required</li>";
                   $success = false;
                }
                /* Check if the confirm password entry is empty */
                if(empty($pwd_confirm)) {
                   $error_msg .= "<li class='list-group-item'>Confirm Password entry is required</li>";
                   $success = false;
                }
                /* Check if passwords match */
                if ($pwd != $pwd_confirm)
                {
                    $error_msg .= "<li class='list-group-item'>Passwords do not match</li>";
                    $success = false;
                }
                else {
                    if($success){
                        /* Hash the Password */
                        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                        save_member_to_db();
                    }
                }

                if($success) {
                    echo "<form class='container p-3' action='login.php'>"
                       . "<h1 class='display-4'>Your registration is sucessful</h1>"
                       . "<p class='lead'>Thank you for signing up, " . $username . "</p>"
                       . "<button class='btn btn-outline-dark' type='submit'>Log-In</button>"
                       . "</form>";
                }
                else {
                    echo "<form class='container p-3' action='register.php'>"
                       . "<h1 class='display-4'>Oops!</h1>"
                       . "<p class='lead'>The following input errors were detected:</p>"
                       . "<ul class='list-group list-group-flush pb-5'>"
                       . $error_msg 
                       . "</ul>"
                       . "<button class='btn btn-outline-dark' type='submit'>Return to Register</button>"
                       . "</form>";
                }

                /* Helper function that checks input for malicious or unwanted content */
                function sanitise_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                /* Helper function to write the member data to the DB */
                function save_member_to_db() {

                    global $username, $email, $hashed_pwd, $success, $error_msg;

                    /* Create database connection */
                    $config = parse_ini_file("../../private/db-config.ini");
                    $conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);

                    /* Check connection */
                    if($conn->connect_error) {
                        $error_msg = "Connection failed: " . $conn->connect_error;
                        $success = false;
                    }
                    else {
                         // Prepare the statement
                        $stmt = $conn->prepare("INSERT INTO user_login (username, email, password) VALUES (?, ?, ?)");

                        // Bind & Execute the query statement:
                        $stmt->bind_param("sss", $username, $email, $hashed_pwd);
                        if(!$stmt->execute())
                        {
                            $error_msg = "Execute failed: (' . $stmt->errno . ')" . $stmt->error;
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