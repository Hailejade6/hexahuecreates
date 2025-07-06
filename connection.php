<?php

    //THIS LINE IS FOR LOCALHOST
    $mysqli = new mysqli("localhost","root","","hexahuecreates_db");
    
    
    //THIS LINE IS FOR WEB HOSTING
    //$mysqli = new mysqli("localhost","hjwebportfolio","hjwebportfolio@2024","portfolio_db");

    if($mysqli -> connect_errno){
        header("location: db_error.php");
        exit(1);
    }
    
  
?>