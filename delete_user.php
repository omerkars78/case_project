<?php

    require "libs/vars.php";
    require "libs/functions.php";

    $id = $_GET["id"];

    if (delete_user($id)) {
        header('Location: index_1.php');
    } else {
        echo "hata";
    } 



?>