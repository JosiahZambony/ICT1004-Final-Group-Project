<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=yes">
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
         // check for admin login
        session_start();
        
         if (($_SESSION['adminid']) != 'nq9dnwqnd9qi2n3ed03ed92n!@#!90e209#@40u0!') {
             header("Location: https://34.145.96.82/ICT1004/card_list.php");
            exit();
        
    }
        include "nav_bar.php";
        ?>
        <section class="row-md">
            <div class="container p-3">
                <h1 class="display-4">Add New Card</h1>
            </div>
        </section>
        <section class="row-md">
            <form class="container p-3" action="process_add_card.php" method="post">
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label class="col-form-label">Card Name:</label>
                    </div>
                    <div class="col-md-11">
                        <input type="text" class="form-control" id="card_name" name="card_name" placeholder="Enter card name" maxlength="45">
                    </div>
                </div>
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label class="col-form-label">Rarity:</label>
                    </div>
                    <div class="col-md-11">
                        <select id="rarity" name="rarity">
                            <option value="common">Common</option>
                            <option value="uncommon">Uncommon</option>
                            <option value="rare">Rare</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                </div>
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label class="col-form-label">Generation:</label>
                    </div>
                    <div class="col-md-11">
                        <select id="generation" name="generation">
                            <option value="1">Gen 1</option>
                            <option value="2">Gen 2</option>
                            <option value="3">Gen 3</option>
                            <option value="4">Gen 4</option>
                            <option value="5">Gen 5</option>
                            <option value="6">Gen 6</option>
                            <option value="7">Gen 7</option>
                            <option value="8">Gen 8</option>
                            <option value="9">Gen 9</option>
                        </select>
                    </div>
                </div>
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label class="col-form-label">Elements:</label>
                    </div>
                    <div class="col-md-11">
                        <input type="checkbox" id="elements" name="elements[]" value="normal">
                        <label> Normal</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="fire">
                        <label> Fire</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="water">
                        <label> Water</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="grass">
                        <label> Grass</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="ground">
                        <label> Ground</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="dark">
                        <label> Dark</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="psychic">
                        <label> Psychic</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="steel">
                        <label> Steel</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="bug">
                        <label> Bug</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="flying">
                        <label> Flying</label><br>
                        <input type="checkbox" id="elements" name="elements[]" value="electric">
                        <label> Electric</label><br>
                    </div>
                </div>
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label class="col-form-label">Type of card:</label>
                    </div>
                    <div class="col-md-11">
                        <select id="rarity" name="type">
                            <option value="basic">Basic Pokemon</option>
                            <option value="stage1">Stage 1 Pokemon</option>
                            <option value="stage2">Stage 2 Pokemon</option>
                            <option value="trainer">Trainer</option>
                            <option value="energy">Energy</option>
                        </select>
                    </div>
                </div>
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label class="col-form-label">Quantity:</label>
                    </div>
                    <div class="col-md-11">
                        <input type="number" id="quantity" name="quantity" min="1">
                    </div>
                </div>
                <div class="form-row pb-3">
                    <div class="col-md-11">
                        <label class="col-form-label">Image Name: <br> *use the same file name and extension as uploaded file</label>
                    </div>
                    <div class="col-md-11">
                        <input type="text" class="form-control" id="link" name="link" placeholder="Image Name here" maxlength="255">
                    </div>
                </div>
                <div class="form-row pb-3 pl-1">
                    <button class="btn btn-outline-dark" type="submit">Add</button>
                </div>
            </form>
        </section>
    </body>
</html>