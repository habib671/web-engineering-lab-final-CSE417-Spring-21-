<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Simple Sidebar - Start Bootstrap Template</title>
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
    <link href="style.css" rel="stylesheet" />
  </head>

  <body>
  <nav class="navbar navbar-light pl-0 pb-0">
<div class="container-fluid">
<a class="navbar-brand" href="index.php">
  
      <img src="img/01.png" alt="logo" />
  </a>
  
</nav>
    <div class="d-flex" id="wrapper" >
      <!-- Sidebar -->
      <div class=" border-right" id="sidebar-wrapper" style="background-color: #002366;">
     
        <div class="list-group list-group-flush">
          <a
            href="index.php"
            
            data-toggle="collapse"
            aria-expanded="false"
            class="list-group-item list-group-item-action text-light" style="background-color: #002366;"
            > Home
          </a>
          <ul class="collapse dashboard-style" id="home">
          </ul>
          <a
            href="#products"
            data-toggle="collapse"
            aria-expanded="false"
            class="list-group-item list-group-item-action text-light"  style="background-color: #002366;"
            > Products</a
          >
          <ul class="collapse dashboard-style" id="products">
            <li>
              <a href="grocery.php" class="text-light">Grocery</a>
            </li>
            <li>
              <a href="dress.php" class="text-light">Dress</a>
            </li>
            <li>
              <a href="electronics.php" class="text-light">Electronics</a>
            </li>
          </ul>
          <a
            href="#login"
            
            data-toggle="collapse"
            aria-expanded="false"
            class="list-group-item list-group-item-action text-light"style="background-color: #002366;"
            > Login</a
          >
          <ul class="collapse dashboard-style" id="login">
          </ul>
         
        
          
        </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav
          class="navbar navbar-expand-lg navbar-light bg-danger border-bottom navham"
        >
                <h4>&lt;&lt;&lt;&lt;&lt;&lt;Special offer upto 70% discount on Grocery items......</h4>
        </nav>
        <div class ="container">
            <div class="row">
                <div class="col-12">
                <h2 style="text-align:center">Grocery Items</h2>

<table>
 <thead>
  <th>Product ID</th>
  <th>Title</th>
  <th>Seller</th>
  <th>Price</th>
  <th>Unit Available</th>
  </thead>
 </table>
<?php 
include "config.php";

$sql = "SELECT * FROM grocery";
$result = $con->query($sql);
?>


<?php
if($result->num_rows > 0){
  while ($row = $result->fetch_assoc()) { ?>

<head>
<style>
thead {
background-color:#dddddd;
}
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}

td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
width:80px;
}

tr:nth-child(even) {
background-color: #dddddd;
}

</style>
</head>
 <body>

 <table>

  <tr>
      
      <td>
      <?php
      echo $row["Product ID"];
      ?>
      </td>
         
      <td>
      <?php
      echo $row["Title"];
      ?>
      </td>
      <td>
      <?php
      echo $row["Seller"];
      ?>
      </td>
      <td>
      <?php
     echo $row["Price"];
      ?>
      </td>
      <td>
      <?php
      echo $row["Unit Available"];
      ?>
      </td>
  </tr>
 
  </table>
 </body>
      
</html>
      
      
      
<?php	}
}

?>
                </div>
</div>
      
      <!-- /#page-content-wrapper -->
      <div class="footer">
      <h2>ID: 181-15-1907</h2>
        <h2>Name: Md Ahsan Habib</h2>
</div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"
      integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy"
      crossorigin="anonymous"
    ></script>

    <!-- Menu Toggle Script -->
    <script src="pdf.js"></script>
  </body>
</html>
