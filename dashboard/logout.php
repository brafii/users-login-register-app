<?php

    //connection to database
    require_once '../connection/dbconnect.php';

    if(isset($_POST['logout'])){

        session_destroy();
        header('Location: ../index.php');

    }


?>