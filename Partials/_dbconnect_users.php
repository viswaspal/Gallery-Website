<?php
$username="root";
$servername="localhost";
$password="";
$database="users";
$con=mysqli_connect($servername,$username,$password,$database);
if(!$con)
{
	die("Sorry We failed to connect users database-->".mysqli_connect_error());
}
else
{
	echo "Connection to users database was successful";
}
?>