<?php
$showAlert=false;
$showError=false;
if($_SERVER['REQUEST_METHOD']=='POST')
{
   
    include 'Partials/_dbconnect_users.php';
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    // $exists=false;
    // Check whether this user name exists
    $existsSql="Select * FROM `users` WHERE `username`='$username'";
    $result=mysqli_query($con,$existsSql);
    $numExistsRows=mysqli_num_rows($result);
    if($numExistsRows>0)
    {
        $showError="Username already exists";
    }
    else
    {
        if(($password==$confirmpassword))
        {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`username`,`password`) VALUES('$username','$hash')";

            $result=mysqli_query($con,$sql);
            if($result)
            {
                $showAlert=true;
            }

        }
        else
        {
            $showError="Passwords do not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>SignUp</title>
  </head>
  <body>
    <?php
    require 'Partials/_nav.php';
    ?>
    <?php
    if($showAlert)
    {
     echo   '<div class="alert alert-success 
            alert-dismissible fade show" role="alert">
            <strong>Success</strong>Your Account Is now Created and you can login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($showError)
    {
     echo   '<div class="alert alert-danger 
            alert-dismissible fade show" role="alert">
            <strong>Error</strong>'.$showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container" >
        <h1 class="text-center">SignUp to our website </h1>

        <form action="/LoginSystem/SignUp.php" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
            
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3">
            <label for="confirmpassword" class="form-label">ConfirmPassword</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
            <div id="emailHelp" class="form-text">Make sure to type the same Password</div>
          </div>
          
          <button type="submit" class="btn btn-primary">SignUp</button>
        </form>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>