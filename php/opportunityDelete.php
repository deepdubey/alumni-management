<?php
    include('dbConn.php');

    $iden = $_GET['id'];
    $delete = "DELETE FROM opportunity WHERE id='$iden'";
    $result = $conn -> query($delete);

    if($result){
        header("Location: http://vcetalumni.ga/php/profile.php");
    }
?>