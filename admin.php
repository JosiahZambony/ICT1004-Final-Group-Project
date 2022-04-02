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

        <title>Register</title>
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
                    <h1>Welcome Admin!</h1>
                    <div class="col-form-label">
                        <a href = "addcard.php">add new card</a>
                    </div>
                    <div class="col-form-label">
                        <a href = "editcard.php">edit qty of cards</a>
                    </div>
                    <div class="col-form-label">
                        <a href = "delcard.php">delete card</a>
                    </div>
                    <div class="col-form-label">
                        <a href = "">logout</a>
                    </div>
                </article>
            </div>
        </section>
    </body>
</html>