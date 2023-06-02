<?php
    include "config.php";

    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $sql = "DELETE FROM `user_details` WHERE `id` = '$user_id'";
        $result = $connection->query($sql);
        if($result)
        {
            header("Location: read.php");
        }
    }
?>