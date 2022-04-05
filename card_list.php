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
                <form class="container p-3">
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="row-md">
                                <label class="form-label text-white" for="card-rarity">Rarity</label>
                            </div>
                            <div class="row-md mb-2">
                                <select class="custom-select" id="card-rarity" name="card-rarity">
                                    <option value="*">All</option>
                                    <option value="common">One</option>
                                    <option value="uncommon">Two</option>
                                    <option value="rare">Three</option>
                                    <option value="others">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row-md">
                                <label class="form-label text-white" for="card-generation">Generation</label>
                            </div>
                            <div class="row-md mb-2">
                                <select class="custom-select" id="card-generation" name="card-generation">
                                    <option value="*">All</option>
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
                                <select class="custom-select" id="card-element" name="card-element">
                                    <option value="*">All</option>
                                    <option value="normal">Normal</option>
                                    <option value="bug">Bug</option>
                                    <option value="dark">Dark</option>
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
                                <select class="custom-select" id="card-type" name="card-type">
                                    <option value="*">All</option>
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
</body>
</html>
