<?php
$login=false;
$showError=false;
if($_SERVER['REQUEST_METHOD']=='POST')
{
   
    include 'Partials/_dbconnect_users.php';
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    

    // $sql="Select * FROM `users` WHERE `username`='$username' AND `password`='$password'";
    $sql="Select * FROM `users` WHERE `username`='$username'";
    $result=mysqli_query($con,$sql);
    
    $num=mysqli_num_rows($result);
    if($num==1)
    {
        while($row=mysqli_fetch_assoc($result))
        {
            if(password_verify($password,$row['password']))
            {
                $login="true";
                session_start();
       
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$username;
                header("location: Welcome.php");
            }
            else
            {
                $showError=true;
            }

        }   
    }
    else
    {
        $showError=true;
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

    <title>Login</title>
  </head>
  <body>
    <?php
    require 'Partials/_nav.php';
    ?>
    <?php
    if($login)
    {
     echo   '<div class="alert alert-success 
            alert-dismissible fade show" role="alert">
            <strong>Success</strong>You are logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if($showError)
    {
     echo   '<div class="alert alert-danger 
            alert-dismissible fade show" role="alert">
            <strong>Error</strong>Passwords do not match.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container" >
        <h1 class="text-center">Login to our website </h1>

        <form action="/LoginSystem/Login.php" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
            
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          
          
          <button type="submit" class="btn btn-primary">Login</button>
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