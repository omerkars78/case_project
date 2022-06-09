<?php
 
 require "libs/connection.php";

 $username = $email = $password = $repassword = "";
 $username_err = $email_err = $password_err = $repassword_err = "";


 if (isset($_POST["register"])) {

     // validate username
     if(empty(trim($_POST["username"]))) { 
         // eğer username alanı boş ise username girmemiz lazım
         $username_err = "username girmelisiniz.";
     } elseif (strlen(trim($_POST["username"])) < 5 or strlen(trim($_POST["username"])) > 15) {
        // username 5-15 karakter arasında olmalıdır
         $username_err = "username 5-15 karakter arasında olmalıdır."; 
     } elseif (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["username"])) {
        // username oluşturuken rakam harf ve _ olması koşulu var
         $username_err = "username sadece rakam, harf ve alt çizgi karakterinden oluşmalıdır."; 
     } else { 

         $sql = "SELECT id FROM users WHERE username = ?";

         if($stmt = mysqli_prepare($connection, $sql)) {
             $param_username = trim($_POST["username"]);
             mysqli_stmt_bind_param($stmt, "s", $param_username);

             if(mysqli_stmt_execute($stmt)) {
                 mysqli_stmt_store_result($stmt);     
// Buradaki else bloğunda bir kontrol yapıyoruz aynı username daha önce alınmış mı kontrolü
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

     // validate email
     if(empty(trim($_POST["email"]))) {
         $email_err = "email girmelisiniz.";
         // Burada e-mail formatını kontrol ediyoruz
     } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { 
         $email_err = "hatalı email girdiniz.";
     } else {
         $sql = "SELECT id FROM users WHERE email = ?";

         if($stmt = mysqli_prepare($connection, $sql)) {
             $param_email = trim($_POST["email"]);
             mysqli_stmt_bind_param($stmt, "s", $param_email);

             if(mysqli_stmt_execute($stmt)) {
                 mysqli_stmt_store_result($stmt);
// burada e mail daha önce varm mı yokmu satırlardan onu arıyoruz ve kontrol etmiş oluyoruz
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

     // validate password
     if(empty(trim($_POST["password"]))) {
         // eğer password alanı boşsa bu alanı doldurmalıyız.
         $password_err = "password girmelisiniz.";
     } elseif (strlen($_POST["password"]) < 6) {
         // password 6 karakterden daha fazla olmalıdır burada bunu declare ediyoruz
         $password_err = "password min. 6 karakter olmalıdır.";
     } else {
         $password = $_POST["password"];
     }

     // validate  re-password
     if(empty(trim($_POST["repassword"]))) {
         // eğer re-password alanı boş ise doldurmanız lazım
         $repassword_err = "repassword girmelisiniz.";
     } else {
         $repassword = $_POST["repassword"];
         // eğer re-password alanı boş değilse ve paralolar birbirinde farklı ise parolalar eşleşmiyor uyarısı yazdır
         if(empty($password_err) && ($password != $repassword)) {
             $repassword_err = "parolalar eşleşmiyor.";
         }
     }

    // username için error yoksa email için yoksa ve password için yoksa artık insert edebiliriz
    if(empty($username_err) && empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";

        if($stmt = mysqli_prepare($connection, $sql)) {
            
             $param_username = $username;
             $param_email = $email;
             $param_password = password_hash($password, PASSWORD_DEFAULT);

             mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            // daha sonrasında login.php sayfasına yönlendirme yapıyoruz. 
             if(mysqli_stmt_execute($stmt)) {
                 header("location: login_1.php");
             } else {
                 echo mysqli_error($connection);
                 echo "hata oluştu";
             }
        }
    }

   
 }

?>
<?php include "views/_header.php" ?>
<body>
    <div class="container my-5 d-flex justify-content-center">
        <div class="col-sm-5">
            <div class="card">
                <form action="register.php"  method="POST" id="form" novalidate>
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
    <?php include "views/_scripts.php" ?>
   
</body>

</html>