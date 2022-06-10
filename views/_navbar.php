<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand">Case Project</a>

        <div class="collapse navbar-collapse">
            
            <ul class="navbar-nav mb-2 mb-lg-0">

                <?php if (isLoggedin()): ?>

                   
                    <li class="nav-item">
                        <a href="#" class="nav-link">Hoş geldiniz, <?php echo $_SESSION["username"]?></a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                
                <?php else: ?>
                
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">Register</a>
                    </li>

                <?php endif; ?>       


            </ul>
           
        </div>
    </div>
</nav>