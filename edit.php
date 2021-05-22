<?php
include 'Partials/_dbconnect_records.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body>

                <?php
                include 'Partials/_nav.php';
                ?>

                <?php
                    if(isset($_POST['edit_data_btn']))
                    {
                        $id= $_POST['edit_id'];

                        $query = "SELECT * FROM `records` WHERE `id` = '$id' ";
                        $query_run = mysqli_query($con,$query);

                        foreach($query_run as $row)
                        {
                ?>
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="edit_id" value = "<?php echo $row['id']?>" >
                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Edit Name" name="edit_name" value = "<?php echo $row['name']?> ">
                                </div>
                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Edit Author" name="edit_author" value = "<?php echo $row['author']?>">
                                </div>
                                <div class="form-group">
                                <input type="text" class="form-control" placeholder="Edit Description" name="edit_description" value = "<?php echo $row['description']?>">
                                </div>
                                <div class="form-group">
                                <input type="file" class="form-control" name="user_image" value = "<?php echo $row['images']?>">
                                </div>
                                <div class="form-group" align="center">
                                <button type="submit" class="btn btn-primary" name="update_btn">UPDATE</button>
                                </div>
                            </form>
                <?php  
                        }

                    }

                ?>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>
