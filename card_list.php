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

        <title>Card List</title>
    </head>
    <body>

        <?php
        include "nav_bar.php";
        ?>
        <section class="row-md">
            <div class="container p-3">
                <h1 class="display-4">Available Cards</h1>
            </div>
        </section>
        <section class="cards">
            <?php
            $config = parse_ini_file("../../private/db-config.ini");
            $conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
            $res=mysqli_query($conn,"select * from cards_info");
            while($row= mysqli_fetch_array($res)){
                ?>
            <div class ="card">
                            <div class ="card-img">    
                                <img src="../ICT1004<?php echo $row["picture_link"]; ?>" alt=""/>
                            </div>
                            <div class ='card-info'>
                                <h1><?php echo $row["name"]; ?></h1>
                                <p>Rarity: <?php echo $row["rarity"];?></p>
                                <p>Generation: <?php echo $row["generation"]?></p>
                                <p>Element: <?php echo $row["element"]?></p>
                                <p>Type: <?php echo $row["type"]?></p>
                                <p>Quantity: <?php echo $row["quantity"]?></p>
                                <p><button>Add to Cart</button></p>

                            </div>

                        </div>
            <?php
            }
            ?>



        </section>
</html>
</body>
</html>
