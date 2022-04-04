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
            $imagesDirectory = "card/";

            if (is_dir($imagesDirectory)) {
                $opendirectory = opendir($imagesDirectory);

                while (($image = readdir($opendirectory)) !== false) {
                    if (($image == '.') || ($image == '..')) {
                        continue;
                    }

                    $imgFileType = pathinfo($image, PATHINFO_EXTENSION);
                    
                    $imgFileName = pathinfo($image, PATHINFO_FILENAME);

                    if (($imgFileType == 'jpg') || ($imgFileType == 'png')) {
                        ?>     
            <div class ="card">
                <div class ="card-img">    
                    <?php
                    echo "<img src='card/" . $image . "'>";
                    ?>" 
                </div>
                <div class ='card-info'>
                    <h1><?php echo $imgFileName?></h1>
                    <p class="price">Price</p>
                    <p>Description</p>
                    <p><button>Add to Cart</button></p>

              </div>

            </div>

<?php

}
}

closedir($opendirectory);
}
?>
  


        </section>
</html>
</body>
</html>
