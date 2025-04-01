<?php

require_once('lib/functions.php');
$db = new plantopia();



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>


    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="admin/adminstyle.css">
    <link rel="stylesheet" type="text/css" href="css/profile-design.css">



    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
   
    
    <style>
.cstm-header .navbar a
{
    font-size: 20px;
    margin: 0 16px;
    color: black;
    text-decoration: none;
}
.cstm-header .navbar a:hover
{
    color: green;
}

</style>

 

</head>
<body>





  

<?php
require_once("admin-header.php");
?>







<section class="content">
    <h1><i class="fa-solid fa-cart-shopping icon" style="color: green;"></i>Orders </h1>

    <div class="container" >

      <div class="adding_function">
        <div class="box" style="background: #77dd77;" onclick="window.location.href='orders.php'">
          <i class="fa-solid fa-folder-tree icon"></i>
          <div class="content-name">
            <a href="#" style="font-size:40px">Pending Orders <span style="font-weight:bold;">(<?php
              
              $pending_count = $db->pending_count();

              echo $pending_count;

              ?>)</span></a>
            </div>
        </div>
  
  
        <div class="box" style="background: #77dd77;" onclick="window.location.href='dispatched orders.php'">
          <i class="fa-solid fa-folder-tree icon"></i>
          <div class="content-name">
            <a href="#" style="font-size:40px" >Dispatched Orders <span style="font-weight:bold;">(<?php
              
              $dispatched_count = $db->dispatched_count();

              echo $dispatched_count;

              ?>)</span></a>
            </div>
        </div>
      </div>

    </div>

    
</section>









<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script type = "text/javascript" src="js/profile.js?v=2"></script>

</body>
</html>