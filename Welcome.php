<?php
require 'Partials/_dbconnect_records.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
    header("location: Login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Welcome - <?php echo $_SESSION['username']?></title>
  </head>
  <body>
    <?php
    require 'Partials/_nav.php';

    ?>
    
    <div class="container">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Welcome - <?php echo $_SESSION['username']?></h4>
          <p>hey how are you doing? Welcome to iSecure. You are logged in as <?php echo $_SESSION['username']?>. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
          <hr>
          <p class="mb-0">Whenever you need to, be sure to logout <a href="/LoginSystem/Logout.php">Using this link</a></p>
        </div>
    </div>

    <?php

    if(isset($_SESSION['success']) && $_SESSION['success'])
    {
      echo '<h2 class="bg-primary text-white">'.$_SESSION['success'].'</h2>';
      unset($_SESSION['success']);
    }
    if(isset($_SESSION['status']) && $_SESSION['status'])
    {
      echo '<h2 class="bg-primary text-white">'.$_SESSION['status'].'</h2>';
      unset($_SESSION['status']);
    }

    ?>

    <h1 align="center">Save Your Image</h1>
  
      <form action="code.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Name" name="user_name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Author" name="user_author">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Description" name="user_description">
        </div>
        <div class="form-group">
          <input type="file" class="form-control" name="user_image" >
        </div>
        <div class="form-group" align="center">
          <button type="submit" class="btn btn-primary" name="save_image">ADD</button>
        </div>
      </form>
    


    <div class="table-responsive">
    <?php
      $query = "SELECT * FROM `records`";
      $query_run = mysqli_query($con,$query);

      if(mysqli_num_rows($query_run)>0)
      {
        
    ?>

      
      <table class="table table-bordered" id="datatable" width="100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Author</th>
            <th>Description</th>
            <th>Image</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>
        <?php
        while($row = mysqli_fetch_assoc($query_run))
        {
        ?>
          <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['author'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><?php echo '<img src="uploads/'.$row["images"].'" width="100px" height="100px" alt="Image"></img>' ?></td>
            <td>
              <form action = 'edit.php' method="post">
                <input type = "hidden" name="edit_id" value = "<?php echo $row['id'] ?>">
                <button type="submit" class="btn btn-success" name="edit_data_btn">EDIT</button>
              </form>
            </td>
            <td>
              <form action = 'code.php' method="post">
                  <input type = "hidden" name="delete_id" value = "<?php echo $row['id'] ?>">
                  <button type="submit" class="btn btn-danger" name="delete_data_btn">DELETE</button>
              </form>
            </td>
          </tr>
        <?php
        }
        ?>
        
        </tbody>
      </table>
    <?php
      }
      else
      {
        echo "No records found";
      }
    ?>
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
