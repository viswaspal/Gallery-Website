<?php
    include 'Partials/_dbconnect_records.php';
    session_start();
    if(isset($_POST['save_image']))
    {
        $name = $_POST['user_name'];
        $author = $_POST['user_author'];
        $description = $_POST['user_description'];
        $images = $_FILES['user_image']['name'];
        
        if(file_exists("uploads/".$_FILES["user_image"]["name"]))
        {
            $store = $_FILES["user_image"]["name"];
            $_SESSION["status"] = "Image already exists .'.$store'";
            header('location:Welcome.php');
        }
        else
        {
            $query = "INSERT INTO `records` (`name`,`author`,`description`,`images`) VALUES ('$name','$author','$description','$images')";
            $query_run = mysqli_query($con,$query);

            if($query_run)
            {
                move_uploaded_file($_FILES['user_image']['tmp_name'],"uploads/".$_FILES["user_image"]["name"]);
                $_SESSION['success'] = 'Image Added Successfully';
                header('location:Welcome.php');
            }
            else
            {
                $_SESSION['success'] = 'Image  Not Added Successfully';
                header('location:Welcome.php');
            }
        }
    }


//     if(isset($_POST['update_btn']))
//     {
//         $edit_id = $_POST['edit_id'];
//         $edit_name = $_POST['edit_name'];
//         $edit_author = $_POST['edit_author'];
//         $edit_description = $_POST['edit_description'];
        
//         $edit_image = $_FILES['user_image']['name'];
//         $facul_query="SELECT * FROM `records` WHRERE `id`='$edit_id'";
//         $facul_query_run = mysqli_query($con,$facul_query);

        
//         foreach($facul_query_run as $facul_row)
//         {
//             if($edit_image==NULL)
//             {
                
//                 $image_data=$facul_row['images'];
//             }
//             else
//             {
                
//                 unlink("uploads/".$facul_row['images']);
//                 $image_data=$edit_image;
                
//             }
//         }
    
//         $query="UPDATE `records` SET `name` = '$edit_name' , `author` = '$edit_author',`description` = '$edit_description' , `images` = '$image_data' WHERE `id` = '$edit_id'";
//         $query_run = mysqli_query($con,$query);
//         if($query_run)
//         {   
//             if($edit_image==NULL)
//             {
//                 $_SESSION['success']="Image updated with existing Image";
//                 header('location:Welcome.php');

                
//             }
//             else
//             {

//                 move_uploaded_file($_FILES['user_image']['tmp_name'],"uploads/".$_FILES["user_image"]["name"]);
//                 $_SESSION['success'] = 'Image Updated Successfully';
//                 header('location:Welcome.php');

//             }
//         }
//         else
//         {
//             $_SESSION['status']="Image Not Updated Successfuly";
//             header('location:Welcome.php');
//         }
//     }


// 











    if(isset($_POST['update_btn']))
    {
        $edit_id = $_POST['edit_id'];
        $edit_name = $_POST['edit_name'];
        $edit_author = $_POST['edit_author'];
        $edit_description = $_POST['edit_description'];
        
        $edit_image = $_FILES['user_image']['name'];
        
    
        $query="UPDATE `records` SET `name` = '$edit_name' , `author` = '$edit_author',`description` = '$edit_description' , `images` = '$edit_image' WHERE `id` = '$edit_id'";
        $query_run = mysqli_query($con,$query);
        if($query_run)
        {   
            move_uploaded_file($_FILES['user_image']['tmp_name'],"uploads/".$_FILES["user_image"]["name"]);
            $_SESSION['success'] = 'Image Updated Successfully';
            header('location:Welcome.php');
        }
        else
        {
            $_SESSION['status']="Image Not Updated Successfuly";
            header('location:Welcome.php');
        }
    }








?>






<?php
    if(isset($_POST['delete_data_btn']))
    {
        $id=$_POST['delete_id'];

        $folder_query = "SELECT * FROM `records` WHERE `id`='$id'";
        $folder_query_run=mysqli_query($con,$folder_query);


        $query = "DELETE FROM `records` WHERE `id` = '$id' ";

        $query_run=mysqli_query($con,$query);

        if($query_run)
        {
            $_SESSION['success']="Image Data is Deleted Now";

            foreach($folder_query_run as $folder_row)
            {
                unlink("uploads/".$folder_row['images']);
            }
            
            header('location:Welcome.php');
        }
        else
        {
            
            $_SESSION['success']="Image Data Not Deleted";
            header('location:Welcome.php');
        }
    }


?>