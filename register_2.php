<?php
 
    require "libs/connection.php";

    $username = $email = $password = $confirm_password = "";


    if (isset($_POST["register"])) {

        // validate username
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
        // validate email
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

        // validate password
      


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

?>



<div class="container my-3">

    <div class="row">

        <div class="col-12">
           
        <div class="card">
           
           <div class="card-body">

               <form action="register_2.php" method="POST" novalidate>

                    <div class="mb-3">
                       <label for="username" class="form-label">username</label>
                       <input type="text" name="username" id="username" class="form-control " value="<?php echo $username; ?>">
                       
                   </div>

                   <div class="mb-3">
                       <label for="email" class="form-label">email</label>
                       <input type="email" name="email" id="email" class="form-control " value="<?php echo $email; ?>">
                      
                   </div>

                   <div class="mb-3">
                       <label for="password" class="form-label">password</label>
                       <input type="password" name="password" id="password" class="form-control " value="<?php echo $password; ?>">
                      
                   </div>

                   <div class="mb-3">
                       <label for="confirm_password" class="form-label">confirm password</label>
                       <input type="password" name="confirm_password" id="confirm_password" class="form-control " value="<?php echo $confirm_password; ?>">
                       
                   </div>

                   <input type="submit" name="register" value="Submit" class="btn btn-primary">
               
               </form>
           </div>
       </div>

        </div>    
    
    </div>

</div>



