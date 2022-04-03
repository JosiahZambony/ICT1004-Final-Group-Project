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

        <title>Admin</title>
    </head>
    <body>
        <?php
        include "nav_bar.php";
        ?>
        <section>
            <?php
            $success = true;
            $error_msg = "";

            $cardname = $_POST["card_name"];
            $qty = $_POST["quantity"];
            $link = $_POST["link"];

            /* Check for empty inputs */
            if (empty($cardname)) {
                $error_msg .= "<li class='list-group-item'>Card name is empty</li>";
                $success = false;
            } else {
                $cardname = sanitise_input($cardname);
            }
            if (empty($qty)) {
                $error_msg .= "<li class='list-group-item'>Quantity is empty</li>";
                $success = false;
            }
            if (empty($link)) {
                $error_msg .= "<li class='list-group-item'>Image Link is empty</li>";
                $success = false;
            } else {
                $link = sanitise_input($link);
            }
            
            
            if ($success){
                edit_card_to_db();
            }
            

            if (!$success) {
                echo "<form class='container p-3' action='editcard.php'>"
                . "<h1 class='display-4'>Oops!</h1>"
                . "<p class='lead'>The following input errors were detected:</p>"
                . "<ul class='list-group list-group-flush pb-5'>"
                . $error_msg
                . "</ul>"
                . "<button class='btn btn-outline-dark' type='submit'>Try Again</button>"
                . "</form>";
            }else{
                header("Location: editcard.php");
            }

            /* Helper function that checks input for malicious or unwanted content */

            function sanitise_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            /* Helper function to write the member data to the DB */

            function edit_card_to_db() {

                global $cardname, $qty, $link, $success, $error_msg;

                /* Create database connection */
                $config = parse_ini_file("../../private/db-config.ini");
                $conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);

                /* Check connection */
                if ($conn->connect_error) {
                    //$error_msg = "Connection failed: " . $conn->connect_error;
                    $error_msg = "Oops connection error!";
                    $success = false;
                } else {
                    // Prepare the statement
                    $stmt = $conn->prepare("UPDATE cards_info SET quantity=?, picture_link=? WHERE name = ?");

                    // Bind & Execute the query statement:
                    $stmt->bind_param("iss", $qty, $link,$cardname);
                    if (!$stmt->execute()) {
                        //$error_msg = "Execute failed: (' . $stmt->errno . ')" . $stmt->error;
                        $error_msg = "Oops failed to edit to db";
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