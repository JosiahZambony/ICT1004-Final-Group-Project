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

        <title>Admin</title>
    </head>
    <body>
        <?php
        include "nav_bar.php";
        ?>
        <section class="row-md">
            <div class="container p-3">
                <h1 class="display-4">Edit Cards</h1>
            </div>
        </section>
        <section class="row-md">
            <table> 
                <tr><th>Card Name</th>
                    <th>Quantity</th>
                    <th>Link</th>
                    <th></th></tr>
                <?php
                edit_card_in_table();

                function edit_card_in_table() {

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


                            while ($row = $result->fetch_assoc()) {
                                echo
                                "<form action='process_edit_card.php' method='post'><tr>"
                                . "<td><input type='hidden' class='form-control' id='card_name' name='card_name' value ='" . $row["name"] . "'>" . $row["name"] . "</td>"
                                . "<td><input type='number' id='quantity' name='quantity' min='1' value = '" . $row["quantity"] . "'></td>"
                                . "<td><input type='text' class='form-control' id='link' name='link' placeholder='Image Link here' maxlength='255' value ='" . $row["picture_link"] . "'></td>"
                                . "<td><button class='btn btn-outline-dark' type='submit'>Update</button></td>"
                                . "</tr></form>";
                            }
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
            </table>
        </section>
    </body>
</html>


