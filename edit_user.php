<?php
    require "libs/vars.php";
    require "libs/functions.php";  

    $id = $_GET["id"];
    $result = get_users($id);
    $selected_user = mysqli_fetch_assoc($result);    

    if ($_SERVER["REQUEST_METHOD"]=="POST") {

        $id = $_POST["id"];
        $username = $_POST["username"];
        $email = $_POST["email"];

        if (edit_users($id, $username, $email)) {
            $_SESSION['message'] = $title." isimli blog güncellendi.";
            $_SESSION['type'] = "success";

            header('Location: index_1.php');
        } else {
            echo "hata";
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
                    <form method="POST">

                        <div class="mb-3">
                            <label for="id" class="form-label">id</label>
                            <input type="number" class="form-control" name="id" id="id" value="<?php echo $selected_user["id"]?>">
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">username</label>
                            <textarea name="username" id="username" class="form-control"><?php echo $selected_user["username"]?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $selected_user["email"]?>">
                        </div>
            

                        <input type="submit" value="Submit" class="btn btn-primary">

                    
                    </form>
                </div>
            </div>

        </div>    
    
    </div>

</div>


