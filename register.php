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
        <section class="row-md">
            <div class="container p-3">
                <h1 class="display-4">Member Registration</h1>
                <p class="lead">For existing members, please go to the 
                    <a href="login.php">Login page</a>
                </p>
            </div>
        </section>
        <section class="row-md">
            <form class="container p-3" action="process_register.php" method="post">
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label for="user_input" class="col-form-label">Username:</label>
                    </div>
                    <div class="col-md-11">
                        <input type="text" class="form-control" id="user_input" name="user_input" placeholder="Enter Username" maxlength="45" required>
                    </div>
                </div>
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label for="email_input" class="col-form-label">Email:</label>
                    </div>
                    <div class="col-md-11">
                        <input type="email" class="form-control" id="email_input" name="email_input" placeholder="Enter Email" required>
                    </div>
                </div>
                <div class="form-row pb-3">
                    <div class="col-md-1">
                        <label for="pwd_input" class="col-form-label">Password:</label>
                    </div>
                   
                   
                    <div class="col-md pb-3">
                        <input type="password" class="form-control" id="pwd_input" name="pwd_input" placeholder="Enter Password" required>
                    
                    </div>
                  
                    
                    <div class="col-md-1.5">
                        <label for="pwd_confirm" class="col-form-label">Confirm Password:</label>
                    </div>
                    <div class="col-md pb-3">
                        <input type="password" class="form-control" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="form-row pb-3 pl-1">
                    <button class="btn btn-outline-dark" type="submit">Register</button>
                </div>
            </form>
        </section>
    </body>
</html>
