<?php
    include('db.php');
    $id = $_GET["id"];
    //print_r($_GET);

    $sql = "DELETE FROM `period` WHERE `no` = '$id'";

    if($conn->query($sql)===TRUE){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        echo "Fail to delete, ".$conn->error;
    }

?>
