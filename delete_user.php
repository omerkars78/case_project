<?php

    require "libs/vars.php";
    require "libs/functions.php";

    $id = $_GET["id"];

    if (delete_user($id)) {
        $_SESSION['message'] = $id." id numaralı blog silindi.";
        $_SESSION['type'] = "danger";
    
        header('Location: index_1.php');
    } else {
        echo "hata";
    } 



?>