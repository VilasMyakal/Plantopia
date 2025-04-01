<?php

require_once('lib/functions.php');
$db = new plantopia();
$data = array();

if(isset($_GET['mobile']))
{
    $mobile = $_GET['mobile'];
    $data=$db->display_user_orders($mobile);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>

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
    <h1><i class="fa-solid fa-bars icon" style="color: green;"></i>Orders </h1>
    <a href="view_user_products.php?excel_export">Excel Report</a>


    <table class="table ">
        <thead>
            <th>Sr No.</th>
            <th>Product</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Time</th>
        </thead>
        <?php

            $counter = 0;
            foreach($data as $record)
            {
                $order_id=$data[$counter]['order_id'];
                $order_image  =  $data[$counter]['order_image'];
                $order_name   =  $data[$counter]['order_name'];
                $quantity     =  $data[$counter]['quantity'];
                $price        =  $data[$counter]['price'];
                $date         =  $data[$counter]['date'];
                $time         =  $data[$counter]['time'];
               ?>
            <tr>
                <td><?php echo $counter+1;?></td>
                <td><img src="<?php echo $order_image;?>" width="100px" height="100px"></td>
                <td><?php echo $order_name;?></td>
                <td>Rs <?php echo $price;?>/-</td>
                <td><?php echo $quantity;?></td>
                <td><?php echo $date?></td>
                <td><?php echo $time?></td>
            </tr>
            <?php
                

                $counter++;
                
            }
            ?>
            <?php
        if(isset($_GET['excel_export']))
            {
                $filename = "view_user_products".date('Ymd') . ".xls";			
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$filename\"");	
                $show_coloumn = false;
                if(!empty($data)) {
                foreach($data as $record) {
                    if(!$show_coloumn) {
                    // display field/column names in first row
                    echo implode("\t", array_keys($record)) . "\n";
                    $show_coloumn = true;
                    }
                    echo implode("\t", array_values($record)) . "\n";
                }
                }
                exit;  
            }?>
        <tbody>
    </table>

  </section>











<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script type = "text/javascript" src="js/profile.js?v=2"></script>

</body>
</html>