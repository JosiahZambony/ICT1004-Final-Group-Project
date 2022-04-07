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

        <title>Card List</title>
    </head>
    <body>

        <?php
        include "nav_bar.php";
        ?>
        <section class="row-md available-cards-banner">
            <div class="container">
                <h1>Available Cards</h1>
            </div>
        </section>
        
        <nav class="navbar navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#filterToggler" 
                aria-controls="filterToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="align-middle"> Filter</span>
            </button>
        </nav>
        
        <div id="filterToggler">
            <section class="row-md filter-list">
                <form class="container p-3" action="card_list.php" method="post">
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="row-md">
                                <label class="form-label text-white" for="card-rarity">Rarity</label>
                            </div>
                            <div class="row-md mb-2">
                                <select class="custom-select" id="card-rarity" name="rarity">
                                    <option value="">Any</option>
                                    <option value="common">Common</option>
                                    <option value="uncommon">Uncommon</option>
                                    <option value="rare">Rare</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row-md">
                                <label class="form-label text-white" for="card-generation">Generation</label>
                            </div>
                            <div class="row-md mb-2">
                                <select class="custom-select" id="card-generation" name="generation">
                                    <option value="">Any</option>
                                    <option value="1">Generation 1</option>
                                    <option value="2">Generation 2</option>
                                    <option value="3">Generation 3</option>
                                    <option value="4">Generation 4</option>
                                    <option value="5">Generation 5</option>
                                    <option value="6">Generation 6</option>
                                    <option value="7">Generation 7</option>
                                    <option value="8">Generation 8</option>
                                    <option value="9">Generation 9</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row-md">
                                <label class="form-label text-white" for="card-element">Element</label>
                            </div>
                            <div class="row-md mb-2">
                                <select class="custom-select" id="card-element" name="element">
                                    <option value="">Any</option>
                                    <option value="normal">Normal</option>
                                    <option value="bug">Bug</option>
                                    <option value="dark">Dark</option>
                                    <option value="dragon">Dragon</option>
                                    <option value="electric">Electric</option>
                                    <option value="fire">Fire</option>
                                    <option value="flying">Flying</option>
                                    <option value="grass">Grass</option>
                                    <option value="ground">Ground</option>
                                    <option value="psychic">Psychic</option>
                                    <option value="steel">Steel</option>
                                    <option value="water">Water</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row-md">
                                <label class="form-label text-white" for="card-type">Type</label>
                            </div>
                            <div class="row-md mb-2">
                                <select class="custom-select" id="card-type" name="type">
                                    <option value="">Any</option>
                                    <option value="basic">Basic Pokemon</option>
                                    <option value="stage1">Stage 1 Pokemon</option>
                                    <option value="stage2">Stage 2 Pokemon</option>
                                    <option value="trainer">Trainer</option>
                                    <option value="energy">Energy</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 pt-2 pb-2">
                            <button class="btn btn-outline-light" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <?php
            /* Start of Query */
            $query = "SELECT * FROM cards_info";
            
            $key = array();
            $value = array();
            
            if(!empty($_POST["rarity"])) {
                $key[] = "rarity";
                $columns[] = '"'.$_POST["rarity"].'"';
            }
            if(!empty($_POST["generation"])) {
                $key[] = "generation";
                $columns[] = $_POST["generation"];
            }
            if(!empty($_POST["element"])) {
                $key[] = "element";
                $columns[] = '"'.$_POST["element"].'"';
            }
            if(!empty($_POST["type"])) {
                $key[] = "type";
                $columns[] = '"'.$_POST["type"].'"';
            }
            
            if(!empty($columns) && !empty($key)) {
                $query .= " WHERE ";
                for($x = 0; $x < count($columns); $x++) {
                    if($x == 0) {
                        $query .= $key[$x] . " = " .$columns[$x];
                    }
                    else {
                        $query .= " AND " . $key[$x] . " = " .$columns[$x];
                    }
                }
            }
            
            $query .= ";";

            /* Create database connection */
            $config = parse_ini_file("../../private/db-config.ini");
            $conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);

            $result = mysqli_query($conn, $query);
            $conn->close();
            
            $x = 0;
            
        ?>
        <section class="container pt-2 pb-2">
        <?php
            echo '<div class="row">';
            while($row= mysqli_fetch_array($result)) {
                if(($x != 0) && ($x%3 == 0)) {
                    echo '</div><div class="row">';
                }
                if($row["quantity"] == 0) {
                    continue;
                }
        ?>
            <div class="card col-md-4 p-0">
                <img class ="card-image" src="../ICT1004<?php echo $row["picture_link"];?>" alt="">
                <div class="card-information">
                    <h1 class="card-title"><?php echo $row["name"];?></h1>
                    <p class="card-rarity">Rarity: <?php echo $row["rarity"];?></p>
                    <p class="card-generation">Generation: <?php echo $row["generation"]?></p>
                    <p class="card-element">Element: <?php echo $row["element"]?></p>
                    <p class="card-type">Type: <?php echo $row["type"]?></p>
                    <p class="card-qty">Quantity: <?php echo $row["quantity"]?></p>
        <?php
                session_start();
                if($_SESSION["name"]) {
                    echo '<form action="process_add_to_cart.php" method="post">';
                    echo '<input type="hidden" id="card-name" name="card-name" value="'.$row["name"].'">';
                    echo '<select class="custom-select" id="choose-qty" name="choose-qty">';
                    for($y = 1; $y <= $row["quantity"]; $y++) {
                        echo "<option value=". $y .">". $y ."</option>";
                    }
                    echo "</select>";
                    echo '<div class="card-btn">';
                    echo '<button class="btn btn-outline-dark" type="submit">Add To Cart</button>';
                    echo '</div>';
                }
                echo '</form>';
        ?>
                </div>
            </div>
        <?php
                $x++;
            }
            echo '</div>';
            $result -> free_result();
        ?>
        </section>
        <?php
            include "footer.php";
        ?>
    </body>
</html>
