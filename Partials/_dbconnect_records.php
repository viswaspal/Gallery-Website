<?php
$username="root";
$servername="localhost";
$password="";
$database="records";
$con=mysqli_connect($servername,$username,$password,$database);
if(!$con)
{
	die("Sorry We failed to connect records database-->".mysqli_connect_error());
}
else
{
	echo "Connection to records database was successful";
}
?>