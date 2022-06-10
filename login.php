<?php

require "libs/vars.php";
require "libs/connection.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

$username =  $password = "";
$username_err = $password_err = $login_err = "";

if (isset($_POST["login"])) {

    if (empty(trim($_POST["username"]))) {
        $username_err = "username girmelisiniz.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "password girmelisiniz.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            $param_username =  $username;
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: index_1.php");
                        } else {
                            $login_err = "yanlış parola girdiniz";
                        }
                    }
                } else {
                    $login_err = "yanlış username girdiniz";
                }
            } else {
                $login_err = "bilinmeyen bir hata oluştu.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($connection);
}

?>

<?php include "views/_header.php" ?>


<div class="container my-3">

    <?php
    if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>

    <div class="row">
        <div class="container my-5 d-flex justify-content-center">
            <div class="col-sm-5">

                <div class="card">

                    <div class="card-body">


                        <form action="login.php" method="POST">
                            <div class="card-header d-flex justify-content-center">Login</div>

                            <div class="mb-3">
                                <label for="username" class="form-label">username</label>
                                <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : '' ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">password</label>
                                <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : '' ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>

                            <input type="submit" name="login" value="Submit" class="btn btn-primary btn-block">

                            <div class="mb3">
                                <a href="register.php" class="form-label">Hesabın yoksa buraya tıklayıp kayıt olabilirsin.</a>
                            </div>

                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>

</div>