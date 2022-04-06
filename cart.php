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
        
        <title>Cart</title>
    </head>
    <body>
        <?php
            include "nav_bar.php";
        ?>
        <?php
            session_start();

            /* Create database connection */
            $config = parse_ini_file("../../private/db-config.ini");
            $conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
            
            /* Check connection */
            if($conn->connect_error) {
                $error_msg .= "Connection issue is found";
                $success = false;
            }
            
            $query = "SELECT * FROM cart_info WHERE buyer = '".$_SESSION["name"]."';";
            
            $result = mysqli_query($conn, $query);
            $conn->close();

            $x = 1;
        ?>
        <section class="row-md cart-banner">
            <div class="container">
                <h1>Cart</h1>
            </div>
        </section>
        <section class="row-md cart-title">
            <div class="container">
                <h1>List for <b>[<?php echo $_SESSION["name"];?>]</b></h1>
            </div>
        </section>
        <section class="row-md cart-table">
            <div class="container">
                <table class="table table-sm">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Card Name</th>
                          <th scope="col">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
            while($row = mysqli_fetch_array($result)) {
        ?>
                        <tr>
                            <th scope="row"><?php echo $x;?></th>
                            <td><?php echo $row["card"];?></td>
                            <td><?php echo $row["quantity"];?></td>
                        </tr>
        <?php
                $x++;
            }
            $result -> free_result();
        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="row-md">
            <div class="container">
                <a href="" class="btn btn-outline-dark mb-3" role="button">Purchase</a>
            </div>
        </section>
    </body>
</html>