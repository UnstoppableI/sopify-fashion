<?php
$server="localhost";
$username="root";
$password="";
$database_name="sopify_web";

$conn = mysqli_connect($server,$username,$password,$database_name);

if($conn->connect_error) 
    die ("Connection failure ".$conn->connect_error);

$C_Name=$_POST['Cardholder Name'];
$Card_Number=$_POST['Card Number'];
$Valid=$_POST['Valid thru'];
$CVV=$_POST['CVV'];
$B_Name=$_POST['Buyer Name'];
$Apartment=$_POST['Apartment'];
$City=$_POST['City'];
$Pincode=$_POST['Pincode'];
$Country=$_POST['Country'];
$Contact=$_POST['Contact'];
/*$sql="INSERT INTO checkout (`Cardholder Name`, `Card Number`, `Valid thru`, `CVV`, `Buyer Name`, `Apartment`, `City`, `Pincode`, `Country`, `Contact`) values ($C_Name,$Card_Number,$Valid,$CVV,$B_Name,$Pincode,$Country)";*/
$sql=[ `Cardholder Name`| `Card Number`| `Valid thru`| `CVV`| `Buyer Name`| `Apartment`|` City`| `Pincode`| `Country`| `Contact` ]
     [ $C_Name|$Card_Number|$Valid|$CVV|$B_Name|$Pincode|$Country|$Contact];

     if($conn->query($sql)==TRUE){
    echo "Database with name checkout";
} else {
    echo "Error: ".$conn->error;
}
//closing connection
$conn->close();

?>