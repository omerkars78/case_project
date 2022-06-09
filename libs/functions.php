<?php


function getData() {
    $myfile = fopen("db.json","r");
    $size = filesize("db.json");
    $result = json_decode(fread($myfile, $size), true);
    fclose($myfile);
    return $result;
}

function createUser(string $name,string $username,string $email,string $password) {
    $db = getData();
    array_push($db["users"], array(
       "id" => count($db["users"]) + 1,
       "username" => $username,
       "password" => $password,
       "name" => $name,
       "email" => $email  
    ));
    $myfile = fopen("db.json","w");
    fwrite($myfile, json_encode($db, JSON_PRETTY_PRINT));
    fclose($myfile);
}

function getUser(string $username) {
    $users = getData()["users"];

    foreach($users as $user) {
        if($user["username"] == $username) {
            return $user;
        }
    }
    return null;
}

