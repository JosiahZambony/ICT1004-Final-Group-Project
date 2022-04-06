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
        
         // check for admin login
        session_start();
        
         if (($_SESSION['name']) != 'nq9dnwqnd9qi2n3ed03ed92n!@#!90e209#@40u0!') {
             header("Location: http://34.145.96.82/ICT1004/card_list.php");
            exit();
        
    }
    include "admin_nav_bar.php";
        ?>
        <section class="row-md">
            <div class="container p-3">
                <h1 class="display-4">Delete Card</h1>
            </div>
        </section>
        <?php
        select_card_in_table();

        function select_card_in_table() {

            global $success, $error_msg;

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
                $stmt = "SELECT * FROM cards_info";
                $result = $conn->query($stmt);
                if ($result->num_rows > 0) {
                    echo
                    "<form action='process_delete_card.php' method='post'><div class='col-md-11'>
                        <label class='col-form-label'>Select which card to delete:</label>
                    </div>"
                    . "<div class='col-md-11'>
                        <select id='card_name' name='card_name'>";

                    while ($row = $result->fetch_assoc()) {
                        echo
                        "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                    }
                    echo "</select></div>"
                    . "<div class='form-row pb-3 pl-1'>
                        <button class='btn btn-outline-dark' type='submit'>Delete</button>
                    </div></form>";
                } else {
                    //$error_msg = "Execute failed: (' . $stmt->errno . ')" . $stmt->error;
                    $error_msg = "No results found";
                    $success = false;
                }
                $stmt->close();
            }
            $conn->close();
        }

        if (!$success) {
            echo $error_msg;
        }
        ?>

    </body>
</html>


