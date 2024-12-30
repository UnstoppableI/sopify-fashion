<?php
$server="localhost";
$username="root";
$password="";
$database_name="sopify_web";

$con = mysqli_connect($server,$username,$password,$database_name);

if($con->connect_error)
die("Connection failure".$con->connect_error);

$sql="SELECT * FROM 'PRODUCT' WHERE 'FIELD' LIKE '%SEARCH%' ";

if($sql==TRUE)
{
    $sql;
}
else{
    echo "Search not found";
}
?>