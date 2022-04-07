<?php
    //ini_set('display_errors', 1);
    session_start();
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    $error_msg = "";
    $content = "";
    $success = true;
    $email_config = parse_ini_file("../../private/email-config.ini");
    $db_config = parse_ini_file("../../private/db-config.ini");
    
    /* Check if member has any record in card list else disallow transaction */
    $conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
    $query_1 = "SELECT EXISTS(SELECT * FROM cart_info WHERE buyer = '".$_SESSION["name"]."') as result;";
    /* Check connection */
    if($conn->connect_error) {
        $error_msg .= "Connection issue is found";
        $success = false;
    }
    else {
        $result_1 = mysqli_query($conn, $query_1);
        $row_1 = mysqli_fetch_array($result_1);
    }
    $conn->close();
    
    if($row_1["result"]) {
        /* Retrieve all records from member from cart list */
        $conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
        $query_2 = "SELECT * FROM cart_info WHERE buyer = '".$_SESSION["name"]."';";
        /* Check connection */
        if($conn->connect_error) {
            $error_msg .= "<li class='list-group-item'>Connection issue is found</li>";
            $success = false;
        }
        else {
            $result_2 = mysqli_query($conn, $query_2);
        }
        $conn->close();

        /* Retrieve email of member from user login table */
        $conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
        $query_3 = "SELECT email FROM user_login WHERE username = '".$_SESSION["name"]."';";
        /* Check connection */
        if($conn->connect_error) {
            $error_msg .= "<li class='list-group-item'>Connection issue is found</li>";
            $success = false;
        }
        else {
            $result_3 = mysqli_query($conn, $query_3);
            $row_3 = mysqli_fetch_array($result_3);
        }
        $conn->close();

        /* Send an email to the members his cart list */
        //Load Composer's autoloader
        require 'PHPMAILER/vendor/autoload.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->Mailer = "smtp";
            $mail->SMTPDebug = 0;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $email_config["username"];              //SMTP username
            $mail->Password   = $email_config["password"];              //SMTP password
            $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('poketradinglegend@gmail.com');
            $mail->addAddress($row_3["email"], $_SESSION["name"]);      //Add a recipient

            //Content
            $mail->isHTML(true);                                        //Set email format to HTML
            $mail->Subject = 'Cards Purchased from PokeTrade.Co';
            $content .= "<h1>Hello fellow Pokemon Trainer. This are the cards you have purchased:</h1>";
            while($row_2 = mysqli_fetch_array($result_2)) {
                $content .= "<p>Card: <b>".$row_2["card"]."</b> Quantity: <b>".$row_2["quantity"]."</b></p>";
            }
            $content .= "<p>Hope you enjoy this cards!</p><p>Have a nice day!</p>";
            $mail->Body    = $content;

            $mail->send();
        } catch (Exception $e) {
            $error_msg .= "<li class='list-group-item'>Email cannot be sent due to server error</li>";
            $success = false;
        }
        
        /* Retrieve all records from member from cart list */
        $conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
        $query_4 = "SELECT * FROM cart_info WHERE buyer = '".$_SESSION["name"]."';";
        /* Check connection */
        if($conn->connect_error) {
            $error_msg .= "<li class='list-group-item'>Connection issue is found</li>";
            $success = false;
        }
        else {
            $result_4 = mysqli_query($conn, $query_4);
        }
        $conn->close();
        
        /* Minus of quantity from cards total based on chosen cards */
        $conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
        /* Check connection */
        if($conn->connect_error) {
            $error_msg .= "<li class='list-group-item'>Connection issue is found</li>";
            $success = false;
        }
        else {
            while($row_4 = mysqli_fetch_array($result_4)) {
                $query_5 = "UPDATE cards_info SET quantity = quantity - ".$row_4["quantity"]." WHERE name = '".$row_4["card"]."';";
                mysqli_query($conn, $query_5);
            }
        }
        $conn->close();
        
        /* Delete the list from the cart table */
        $conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
        $query_6 = "DELETE FROM cart_info WHERE buyer = '".$_SESSION["name"]."';";
        /* Check connection */
        if($conn->connect_error) {
            $error_msg .= "<li class='list-group-item'>Connection issue is found</li>";
            $success = false;
        }
        else {
            mysqli_query($conn, $query_6);
        }
        $conn->close();
        $result_2 -> free_result();
        $result_3 -> free_result();
        $result_4 -> free_result();
    }
    else {
        $error_msg .= "<li class='list-group-item'>No purchase was made</li>";
        $success = false;
    }
    $result_1 -> free_result();
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
        <script src="https://kit.fontawesome.com/20af070e50.js" crossorigin="anonymous"></script>
        
        <title>Login</title>
    </head>
    <body>
        <?php
            include "nav_bar.php";
        ?>
        <section>
        <?php
            if($success) {
        ?>
            <form class='container p-3' action='index.php'>
                <h1 class='display-4'>Successful Transaction has been made!</h1>
                <p>An email will be sent to you with a list of your orders. Have a good day!</p>
                <button class='btn btn-outline-dark' type='submit'>Home</button>
            </form>
        <?php
            }
            else {
        ?>
            <form class='container p-3' action='card_list.php'>
                <h1 class='display-4'>Oops!</h1>
                <p class='lead'>The following input errors were detected:</p>
                <ul class='list-group list-group-flush pb-5'><?php echo $error_msg; ?></ul>
                <button class='btn btn-outline-dark' type='submit'>Return to Card List</button>
            </form>
        <?php
            }
        ?>
        </section>
    </body>
</html>