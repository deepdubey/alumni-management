<?php
    include('../dbConn.php');

    $iden = $_GET['id'];
    $delete = "DELETE FROM alumni WHERE id='$iden'";
    $result = $conn -> query($delete);

    if($result){
        header("Location: getAlumni.php");
    }
?>