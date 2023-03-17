<?php
require('../connect.php');


$sql = "delete from customer where CustomerID = :CustomerID";
$stml = $conn->prepare($sql);
$stml->bindParam(':CustomerID',$_GET['CustomerID']);

if($stml->execute()){
    $message = "Successfully delete customer".$_GET['CustomerID'].".";
}else{
    $message = "Fail to delete customer information.";
}
echo $message;
$conn = null;





?>


