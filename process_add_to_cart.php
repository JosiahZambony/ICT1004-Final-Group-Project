<?php
    session_start();
    $success = true;
    $error_msg = "";
    
    /* Create database connection */
    $config = parse_ini_file("../../private/db-config.ini");
    $conn = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
    
    /* Check connection */
    if($conn->connect_error) {
        $error_msg = "<li class='list-group-item'>Connection issue is found</li>";
        $success = false;
    }
    else {
        // Check if the record exists within records
        $result = mysqli_query($conn, 'SELECT EXISTS(SELECT * FROM cart_info WHERE card="'.$_POST["card-name"].'" AND buyer = "'.$_SESSION["name"].'") AS exist;');
        $row = mysqli_fetch_array($result);
        if($row[exist]) {
            /* Check if the quantity exceeds the limit */
            /* Retrieve the card chosen records for member from cart list */
            $query_1 = "SELECT quantity FROM cart_info WHERE buyer = '".$_SESSION["name"]."' AND card = '".$_POST["card-name"]."';";
            $result_1 = mysqli_query($conn, $query_1);
            $row_1 = mysqli_fetch_array($result_1); 
            $projected_total = (int)$row_1["quantity"] + (int)$_POST["choose-qty"];
            /* Retrieve the quantity of card chosen records from card list */
            $query_2 = "SELECT quantity FROM cards_info WHERE name = '".$_POST["card-name"]."';";
            $result_2 = mysqli_query($conn, $query_2);
            $row_2 = mysqli_fetch_array($result_2);
            /* If projected total does not exceed limit of stock then update */
            if((int)$row_2["quantity"] >= $projected_total) {
                mysqli_query($conn, "UPDATE cart_info SET quantity = quantity + ".$_POST["choose-qty"]." WHERE buyer = '".$_SESSION["name"]."' AND card = '".$_POST["card-name"]."'");    
            }
            else {
                $error_msg = "<li class='list-group-item'>Cannot add anymore cards due to stock limit</li>";
                $success = false;
            }
        }
        else {
            // Prepare the statement
            $stmt = $conn->prepare("INSERT INTO cart_info (card, buyer, quantity) VALUES (?, ?, ?)");

            // Bind & Execute the query statement:
            $stmt->bind_param("sss", $_POST["card-name"], $_SESSION["name"], $_POST["choose-qty"]);
            if(!$stmt->execute())
            {
                $error_msg = "<li class='list-group-item'>An issue is found contact Adminstrator</li>";
                $success = false;
            }
            $stmt->close();
        }
    }
    $conn->close();
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
        
        <title>Card List</title>
    </head>
    <body>
        <?php
            include "nav_bar.php";
        ?>
        <div class="container p-3">
        <?php
            if($success) {
        ?>
            <h1 class='display-4'>Successfully added to cart!</h1>
            <p class='lead'>Successfully added to cart</p>
            <div class="row p-3">
                <div class="row-md-3 mr-2">
                    <a href="card_list.php" class="btn btn-outline-dark mb-3" role="button">Back to Card List</a>
                </div>
                <div class="row-md-3 mr-2">
                    <a href="cart.php" class="btn btn-outline-dark mb-3" role="button">Go to Cart</a>
                </div>
            </div>
        <?php
            }
            else {
        ?>
            <h1 class='display-4'>An error occurred when processing</h1>
            <p class='lead'>The following input errors were detected:</p>
            <ul class='list-group list-group-flush pb-5'><?php echo $error_msg ?></ul>
            <div class="row p-3">
                <div class="row-md-3 mr-2">
                    <a href="card_list.php" class="btn btn-outline-dark mb-3" role="button">Back to Card List</a>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </body>
</html>