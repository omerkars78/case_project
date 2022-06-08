<?php

    require "libs/vars.php";
    // require "libs/functions.php";  
    require "libs/ayar.php";

    $username = $email = $password = $confirm_password = "";
    $username_err = $email_err = $password_err = $confirm_password_err = "";


    if (isset($_POST["register"])) {

        // validate username
        if(empty(trim($_POST["username"]))) {
            $username_err = "username girmelisiniz.";
        } elseif (strlen(trim($_POST["username"])) < 5 or strlen(trim($_POST["username"])) > 15) {
            $username_err = "username 5-15 karakter arasında olmalıdır.";
        } elseif (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["username"])) {
            $username_err = "username sadece rakam, harf ve alt çizgi karakterinden oluşmalıdır.";
        } else {
            $username = $_POST["username"];
        }

        // validate email
        if(empty(trim($_POST["email"]))) {
            $email_err = "email girmelisiniz.";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email_err = "hatalı email girdiniz.";
        } else {
            $email = $_POST["email"];
        }

        // validate password
        if(empty(trim($_POST["password"]))) {
            $password_err = "password girmelisiniz.";
        } elseif (strlen($_POST["password"]) < 6) {
            $password_err = "password min. 6 karakter olmalıdır.";
        } else {
            $password = $_POST["password"];
        }

        // validate confirm password
        if(empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "confirm_password girmelisiniz.";
        } else {
            $confirm_password = $_POST["confirm_password"];
            if(empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "parolalar eşleşmiyor.";
            }
        }


       

      
    }

?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

    <div class="row">

        <div class="col-12">
           
        <div class="card">
           
           <div class="card-body">

               <form action="register.php" method="POST" novalidate>

                <div class="mb-3">
                       <label for="username" class="form-label">username</label>
                       <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid': ''?>" value="<?php echo $username; ?>">
                       <span class="invalid-feedback"><?php echo $username_err; ?></span>
                   </div>

                   <div class="mb-3">
                       <label for="email" class="form-label">email</label>
                       <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid': ''?>" value="<?php echo $email; ?>">
                       <span class="invalid-feedback"><?php echo $email_err; ?></span>
                   </div>

                   <div class="mb-3">
                       <label for="password" class="form-label">password</label>
                       <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid': ''?>" value="<?php echo $password; ?>">
                       <span class="invalid-feedback"><?php echo $password_err; ?></span>
                   </div>

                   <div class="mb-3">
                       <label for="confirm_password" class="form-label">confirm password</label>
                       <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid': ''?>" value="<?php echo $confirm_password; ?>">
                       <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                   </div>

                   <input type="submit" name="register" value="Submit" class="btn btn-primary">
               
               </form>
           </div>
       </div>

        </div>    
    
    </div>

</div>

<?php include "views/_footer.php" ?>

