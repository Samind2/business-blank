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

$sql_select ="select * from country order by CountryCode" ;
$stmt = $conn->prepare($sql_select);
$stmt->execute();
echo "CustomerID = ".$_GET['CustomerID'];

if (isset($_GET['CustomerID'])) {
    $sql_select_customer = 'SELECT * FROM customer WHERE CustomerID=?';
    $stmt = $conn->prepare($sql_select_customer);
    $stmt->execute([$_GET['CustomerID']]);
    echo "get = ".$_GET['CustomerID'];
    $result = $stmt->fetchAll();
}
?>

    
<div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
          <h3>ฟอร์มแก้ไขข้อมูลลูกค้า</h3>
          <form action="updateCustomer.php" method="POST">
           <input type="hidden" name="CustomerID" value="CustomerID">
            
                <label for="name" class="col-sm-2 col-form-label"> ชื่อ:  </label>
              
                <input type="text" name="Name" class="form-control" required value="<?= $result['Name']; ?>">            
           
            
                <label for="name" class="col-sm-2 col-form-label"> อีเมล์ :  </label>
             
                <input type="email" name="Email" class="form-control" required value="<?= $result['Email']; ?>">
          
            <br> <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>