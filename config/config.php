<?php
    ob_start();//Turns on output buffering
    session_start();

    $timezone = date_default_timezone_set("Asia/Kolkata");
    //Establish connection with the database.
    $con = mysqli_connect("localhost","root","","facenovel");
    if(mysqli_connect_errno()){
        echo "Failed to connect to the database:". mysqli_connect_errno(); 
    }

?>