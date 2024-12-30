
<?php
$server="localhost";
$username="root";
$password="";
$database_name="sopify_web";

$conn = mysqli_connect($server,$username,$password,$database_name);
if($conn->connect_error) 
    die ("Connection failure ".$conn->connect_error);

?>