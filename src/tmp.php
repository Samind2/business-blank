<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>CRUD Customer</title>
  </head>
  <body>

<?php
require '../connect.php';

$sql_select = 'select * from country order by CountryCode';
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();
echo "Nee".$_GET['CustomerID'];

if (isset($_GET['CustomerID'])) {
    $sql_select_customer = 'SELECT * FROM customer WHERE CustomerID=?';
    $stmt = $conn->prepare($sql_select_customer);
    $stmt->execute([$_GET['CustomerID']]);
    echo "get = ".$_GET['CustomerID'];
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

}
?>

    
<div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
          <h4>ฟอร์มแก้ไขข้อมูล</h4>
          <form action="updateCustomer.php" method="POST">
           <input type="hidden" name="CustomerID" value="<?= $result['CustomerID'];?>">
            <div class="mb-1">
              <label for="name" class="col-sm-2 col-form-label"> ชื่อ:  </label>
              <div class="col-sm-10">
                <input type="text" name="Name" class="form-control" required value="<?= $result['Name'];?>">
              </div>
            </div>
            <div class="mb-1">
              <label for="name" class="col-sm-2 col-form-label"> อีเมล์ :  </label>
              <div class="col-sm-10">
                <input type="email" name="Email" class="form-control" required value="<?= $result['Email'];?>">
              </div>
            </div>
         
            <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Update customer </title>
  </head>
  <body>

<?php
require '../connect.php';

$sql_select = 'select * from country order by CountryCode';
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();
echo "CustomerID = ".$_GET['CustomerID'];

if (isset($_GET['CustomerID'])) {
    $sql_select_customer = 'SELECT * FROM customer WHERE CustomerID=?';
    $stmt = $conn->prepare($sql_select_customer);
    $stmt->execute([$_GET['CustomerID']]);
    echo "get = ".$_GET['CustomerID'];
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

    
<div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
          <h1>Update customer information</h1>
          <form action="updateCustomer.php" method="POST">
           <input type="hidden" name="CustomerID" value="<?= $result['CustomerID'];?>">
            
                <label for="name" class="col-sm-2 col-form-label"> ชื่อ:  </label>
              
                <input type="text" name="Name" class="form-control" required value="<?= $result['Name'];?>">           
           
            
                <label for="name" class="col-sm-2 col-form-label"> อีเมล์ :  </label>
             
                <input type="email" name="Email" class="form-control" required value="<?= $result['Email'];?>">
          
            <br> <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>



<?php
require '../connect.php';

$sql_select = 'select * from country order by CountryCode';
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();

if (isset($_POST['submit'])) {
    //if ((isset($_POST['customerID']) && isset($_POST['name'])) != null)
    if (!empty($_POST['customerID']) && !empty($_POST['name'])) {
        echo '<br>' . $_POST['customerID'];
        //require 'connect.php';

        $sql = "insert into customer 
							values (:customerID, :Name, :birthdate, :email, :countrycode,
							:outstandingDebt, :image)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':customerID', $_POST['customerID']);
        $stmt->bindParam(':Name', $_POST['name']);
        $stmt->bindParam(':birthdate', $_POST['birthdate']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':countrycode', $_POST['countrycode']);
        $stmt->bindParam(':outstandingDebt', $_POST['outstandingDebt']);
        $stmt->bindParam(':image', $_POST['email']);

        try {
            if ($stmt->execute()):
                $message = 'Successfully add new customer';
            else:
                $message = 'Fail to add new customer';
            endif;
            echo $message;
        } catch (PDOException $e) {
            echo 'Fail! ' . $e;
        }

        $conn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Registration</title>
</head>
<body>
<div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
	<h1>Add Customer 651</h1>
	<form  action="addCustomer_dropdown.php" method="POST">

	  <input type="text" placeholder="Enter Customer ID" name="customerID"> 
	  <br> <br>
	  <input type="text" placeholder="Name" name="name">
	  <br> <br>
	  <input type="date" placeholder="Birthdate" name="birthdate">
	  <br> <br>
	  <input type="email" placeholder="Email" name="email">
	  <br> <br>     
	  <input type="number" placeholder="OutStanding debt" name="outstandingDebt">
      <br> <br> 
      <label>Select a country code</label>
        <select name="countrycode">
            <?php while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $cc['CountryCode']; ?>">
                    <?php echo $cc['CountryName']; ?>
                </option>
            <?php } ?>
        </select>       
      <br> <br>

	  <input type="submit" value="Submit" name="submit" />
	</form>
            </div>
            </div>
            </div>
</body>
</html>


<?php

require('../connect.php');


$sql = "delete from customer where CustomerID = :customerID";
$stml = $conn->prepare($sql);
$stml->bindParam(':customerID',$_GET['CustomerID']);

if($stml->execute()){
    $message = "Successfully delete customer".$_GET['CustomerID'].".";
}else{
    $message = "Fail to delete customer information.";
}
echo $message;
$conn = null;



?>


