<?php
    define("HOSTNAME","localhost");
    define("USERNAME","root");
    define("PASSWORD","");
    define("DATABASE","food");

    $connection=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
    if(!$connection){
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

?>