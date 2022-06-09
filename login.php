<?php

    require "libs/vars.php";
    require "libs/functions.php";  

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = getUser($username);

        if (!is_null($user) and $username == $user["username"] and $password == $user["password"]) {

            setcookie("auth[username]", $user["username"], time() + (60*60));
            setcookie("auth[name]", $user["name"], time() + (60*60));

            header('Location: index.php');
        } else {
            echo "<div class='alert alert-danger mb-0 text-center'>Yanlış username ve parola</div>";
        }
    }

?>
<?php include "views/_header.php" ?>
<body>
    

<div class="container my-3">

<div class="container my-5 d-flex justify-content-center">
        <div class="col-sm-5">
            <div class="card">
                <form action="register.php"  method="POST" id="form" novalidate>
                    <div class="card-header d-flex justify-content-center">Login</div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="username" class="form-label" value="<?php echo $username; ?>">Username</label>
                            <input type="text" name="username" id="username" class="form-control ">
                            <div></div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label" value="<?php echo $password; ?>">Password</label>
                            <input type="password" name="password" id="password" class="form-control ">
                            <div></div>
                        </div>


                        <input type="submit" name="register" value="Submit" class="btn btn-primary btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?php include "views/_scripts.php" ?>
</body>

