<!DOCTYPE html>
<main>
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
        
        <title>PokeTrade.Co: Trading Cards</title>
    </head>
    <body>
        <?php
            include "nav_bar.php";
        ?>
        <section class="row white-bg-img">
            <div class="col-md p-3">
                <img class="pikachu-img img" src="images/pikachu.png" alt="Pikachu Picture">
            </div>
            <div class="message-box col-md ml-5 mr-5 p-3 align-self-center">
                <article class="container py-auto">
                    <h1>Welcome to PokeTrade!</h1>
                    <p class="lead">Need to find a card?</p>
                    <a href="card_list.php" class="btn btn-outline-dark mb-3" role="button">Click here to start</a>
                    </article>
            </div>
        </section>
        <?php
            include "footer.php";
        ?>
    </body>
</html>
</main>