<!DOCTYPE html>
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
            <form id="form" novalidate>
            <div class="card-header d-flex justify-content-center">Create User</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Please Enter Username">
                    <div></div>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Please Enter E-mail">
                    <div></div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" class="form-control" id="phone" placeholder="Please Enter Phone Number">
                    <div></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Please Enter Password">
                    <div></div>
                </div>
                
                <div class="form-group">
                    <label for="repassword">Re-Password</label>
                    <input type="password" class="form-control" id="repassword" placeholder="Please Enter Repassword">
                    <div></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            </div>
        </div>
    </div>
</div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>