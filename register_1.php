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
            
            <div class="mb-3">
                       <label for="username" class="form-label">username</label>
                       <input type="text" name="username" id="username" class="form-control ">
                       <span class="invalid-feedback"></span>
                   </div>

                   <div class="mb-3">
                       <label for="email" class="form-label">email</label>
                       <input type="email" name="email" id="email" class="form-control ">
                       <span class="invalid-feedback"></span>
                   </div>

                   <div class="mb-3">
                       <label for="password" class="form-label">password</label>
                       <input type="password" name="password" id="password" class="form-control ">
                       <span class="invalid-feedback"></span>
                   </div>

                   <div class="mb-3">
                       <label for="confirm_password" class="form-label">confirm password</label>
                       <input type="password" name="confirm_password" id="confirm_password" class="form-control ">
                       <span class="invalid-feedback"></span>
                   </div>

                   <input type="submit" name="register" value="Submit" class="btn btn-primary">
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
