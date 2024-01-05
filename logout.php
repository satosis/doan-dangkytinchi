<?php
    include("db.php");
    $id = $_COOKIE['id'];
    $updateStatus = "UPDATE `user` SET `status`= 2 WHERE `id`='$id' ";
    $conn->query($updateStatus);
    setcookie("id","",time()-30);
    setcookie("username","",time()-30);
    setcookie("day","",time()-30);

    header("Location:login.php");

?>
