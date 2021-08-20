<?php
include_once('includes/conn.php'); 

    $origin=$_GET['origin'];


    $query=$conn->prepare("delete from agents where origin='$origin'");
    $reult=$query->execute();
    header("location:agents_list.php");
?>