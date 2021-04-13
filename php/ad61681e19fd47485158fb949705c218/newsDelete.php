<?php
    include('../dbConn.php');

    $iden = $_GET['id'];
    $delete = "DELETE FROM clgnews WHERE id='$iden'";
    $result = $conn -> query($delete);

    if($result){
        header("Location: getNews.php");
    }
?>