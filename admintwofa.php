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
        
        <title>Login</title>
    </head>
    <body>
        <?php
            include "nav_bar.php";
        ?>
        <section class="row-md">
            <div class="container p-3">
                <h1 class="display-4">Admin 2FA</h1>
                <p class="lead">
                    Please enter the 2FA code from the Google Authenticator App.
                </p>
            </div>
        </section>
        <section class="row-md">
            <form class="container p-3" action="twofa_process.php" method="post">
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label for="user_input" class="col-form-label">2FA Code:</label>
                    </div>
                    <div class="col-md-11">
                        <input type="text" class="form-control" id="user_input" name="twofa" placeholder="Enter 2FA" required>
                    </div>
                </div>
                
                <div class="form-row pb-3 pl-1">
                    <button class="btn btn-outline-dark" type="submit">Submit</button>
                </div>
            </form>
        </section>
    </body>
</html>
