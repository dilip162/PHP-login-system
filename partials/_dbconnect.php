<?php

$server="localhost";
$username="root";
$password="";
$database="users";


$conn=mysqli_connect($server,$username,$password,$database);
if($conn){
    echo "database connect";
}
else{
   die("Database is not connected successfully". mysqli_connect_error());
}

?>