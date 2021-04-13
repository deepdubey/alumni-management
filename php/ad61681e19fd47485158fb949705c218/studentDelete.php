<?php
    include('../dbConn.php');

    $iden = $_GET['id'];
    $delete = "DELETE FROM students WHERE id='$iden'";
    $result = $conn -> query($delete);

    if($result){
        header("Location: getStudents.php");
    }
?>