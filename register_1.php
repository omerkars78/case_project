
<?php
 
 require "libs/connection.php";

 $username = $email = $password = $confirm_password = "";
 $username_err = $email_err = $password_err = $confirm_password_err = "";


 if (isset($_POST["register"])) {

     
     if($_POST["username"]) {
         $sql = "SELECT id FROM users WHERE username = ?";

         if($stmt = mysqli_prepare($connection, $sql)) {
             $param_username = trim($_POST["username"]);
             mysqli_stmt_bind_param($stmt, "s", $param_username);

             if(mysqli_stmt_execute($stmt)) {
                 mysqli_stmt_store_result($stmt);

                 if(mysqli_stmt_num_rows($stmt) == 1) {
                     $username_err = "username daha önce alınmış.";
                 } else {
                     $username = $_POST["username"];
                 }
             } else {
                 echo mysqli_error($connection);
                 echo "hata oluştu";
             }
         }

     } 

     if($_POST["email"]) {
         $sql = "SELECT id FROM users WHERE email = ?";

         if($stmt = mysqli_prepare($connection, $sql)) {
             $param_email = trim($_POST["email"]);
             mysqli_stmt_bind_param($stmt, "s", $param_email);

             if(mysqli_stmt_execute($stmt)) {
                 mysqli_stmt_store_result($stmt);

                 if(mysqli_stmt_num_rows($stmt) == 1) {
                     $email_err = "email daha önce alınmış.";
                 } else {
                     $email = $_POST["email"];
                 }
             } else {
                 echo mysqli_error($connection);
                 echo "hata oluştu";
             }
         }
     }  

    if($_POST["username"] && $_POST["email"] && $_POST["password"]) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";

        if($stmt = mysqli_prepare($connection, $sql)) {
            
             $param_username = $username;
             $param_email = $email;
             $param_password = password_hash($password, PASSWORD_DEFAULT);

             mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

             if(mysqli_stmt_execute($stmt)) {
                 header("location: login.php");
             } else {
                 echo mysqli_error($connection);
                 echo "hata oluştu";
             }
        }
    }

   
 }

?><!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Form Validator</title>
</head>

<body>

    <div class="container my-5 d-flex justify-content-center">
        <div class="col-sm-5">
            <div class="card">
                <form action="register_1.php"  method="POST" id="form" novalidate>
                    <div class="card-header d-flex justify-content-center">Create User</div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="username" class="form-label" value="<?php echo $username; ?>">Username</label>
                            <input type="text" name="username" id="username" class="form-control ">
                            <div></div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label" value="<?php echo $email; ?>">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control ">
                            <div></div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label" value="<?php echo $password; ?>">Password</label>
                            <input type="password" name="password" id="password" class="form-control ">
                            <div></div>
                        </div>

                        <div class="form-group">
                            <label for="repassword" class="form-label">Re-password</label>
                            <input type="password" name="repassword" id="repassword" class="form-control ">
                            <div></div>
                        </div>

                        <input type="submit" name="register" value="Submit" class="btn btn-primary btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const repassword = document.getElementById('repassword');


function error(input, message) {
    input.className = 'form-control is-invalid';
    const div = input.nextElementSibling;
    div.innerText = message;
    div.className = 'invalid-feedback';
}

function success(input) {
    input.className = 'form-control is-valid';
}

function checkEmail(input) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (re.test(input.value)) {
        success(input);
    } else {
        error(input, 'Wrong type');
    }
}

function check_required(inputs) {
    inputs.forEach(function (input) {
        if (input.value === '') {
            error(input, `${input.id} is required.`);
        } else {
            success(input);
        }
    });
}


function check_length(input, min, max) {
    if (input.value.length < min) {
        error(input, ` This side must be minimum ${min} characther.`);
    } else if (input.value.length > max) {
        error(input, `This side must be maximum ${max} characther.`);
    } else {
        success(input);
    }
}

function check_password(pword, repword) {
    if (pword.value !== repword.value) {
        error(repassword, "Passwords are not match!");
    }
}



form.addEventListener('submit', function (e) {
    e.preventDefault();

    check_required([username, email, password, repassword]);
    checkEmail(email);
    check_length(username, 5, 21);
    check_length(password, 5, 21);
    check_password(password, repassword);
}); </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>