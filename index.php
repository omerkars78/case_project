<?php

    require "libs/vars.php";
    require "libs/functions.php";  
    if(!isLoggedin()) {
        header("location: login.php");
        exit;
    }


?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">

    <div class="row">
     
        <div class="col-12">
    
           <h3>Merhaba, <?php echo htmlspecialchars($_SESSION["username"])?></h3>
           <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Create Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $result = get_users();  while($user = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $user["id"]?></td>
                            <td><?php echo $user["username"]?></td>
                            <td><?php echo $user["email"]?></td>
                            <td><?php echo $user["create_time"]?></td>
                            
                            <td>
                                <a class="btn btn-warning btn-sm" href="edit_user.php?id=<?php echo $user["id"]?>">edit</a>
                                <a class="btn btn-danger btn-sm" href="delete_user.php?id=<?php echo $user["id"]?>">delete</a>                
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
           <div>
                <a href="logout.php" class="btn btn-danger">Logout</a>
           </div>

        </div>    
    
    </div>

</div>


