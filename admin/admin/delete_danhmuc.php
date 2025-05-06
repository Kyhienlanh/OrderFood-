<?php
    session_start();
    if(isset($_SESSION["username"]))
        $username = $_SESSION["username"];
    else
        header(("location:list_danhmuc.php"));
    include("../include/db.php");
    $id     = $_GET["id"];
    $sql    = "delete from danhmuc where id_danhmuc=$id";
    $rs     = mysqli_query($connection, $sql);

    if($rs)
        header("location:list_danhmuc.php");
?>