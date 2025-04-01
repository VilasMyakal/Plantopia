<?php

require_once('lib/functions.php');
$db = new plantopia();
error_reporting(0);
if(isset($_GET['mobile']))
{
    $mobile_no = $_GET['mobile'];
    $order_status = "Dispatched";
    $db->dispatch_order($mobile_no,$order_status);
}

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
    <h1><i class="fa-solid fa-bars icon" style="color: green;"></i>Orders </h1>

    <table class="table ">
        <thead>
            <th>Sr No.</th>
            <th>Customer Name</th>
            <th>Mobile No.</th>
            <th>Address</th>
            <th>City</th>
            <th>ZipCode</th>
            <th>Total Buy</th>
            <th>Status</th>
            <th>Date</th>
            <th>Time</th>
            <th>Operation</th>
            <th>Operation</th>

        </thead>
        <?php
            $data =array();
            $data = $db->displayorders();

            $counter = 0;
            foreach($data as $record)
            {
                $user_full_name =  $data[$counter]['user_full_name'];
                $mobile_no      =  $data[$counter]['mobile_no'];
                $address        =  $data[$counter]['address'];
                $city           =  $data[$counter]['city'];
                $zipcode        =  $data[$counter]['zipcode'];
                $total          =  $data[$counter]['total'];
                $status         =  $data[$counter]['status'];
                $date           =  $data[$counter]['date'];
                $time           =  $data[$counter]['time'];
               ?>
            <tr>
                <td><?php echo $counter+1;?></td>
                <td><?php echo $user_full_name;?></td>
                <td><?php echo $mobile_no;?></td>
                <td><?php echo $address;?></td>
                <td><?php echo $city;?></td>
                <td><?php echo $zipcode;?></td>
                <td>Rs <?php echo $total;?>/-</td>
                <td><?php echo $status;?></td>
                <td><?php echo $date;?></td>
                <td><?php echo $time;?></td>

                <td><a href="view_user_products.php?mobile=<?php echo $mobile_no; ?>">View Orders</a></td>
                <td><a href="orders.php?mobile=<?php echo $mobile_no; ?>">Dispatch</a></td>
            </tr>
            <?php
                

                $counter++;
                
            }
            ?>
        <tbody>
    </table>

  </section>











<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script type = "text/javascript" src="js/profile.js?v=2"></script>

</body>
</html>