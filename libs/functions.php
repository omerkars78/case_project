<?php
function isLoggedin() {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        return true;
    } else {
        return false;
    }
}
function get_users() {
    include "connection.php";

    $query = "SELECT users.id , users.username , users.email , users.create_time from users";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
function delete_user(int $id) {
    include "connection.php";
    $query = "DELETE FROM users WHERE id=$id";
    $result = mysqli_query($connection,$query);
    return $result;
}
?>
