<?php
    session_start();
    
     if (isset($_SESSION['adminid'])){
            unset($_SESSION["adminid"]);
     }

    
    unset($_SESSION["name"]);
    header("Location:index.php");
?>