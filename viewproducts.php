<?php

require_once('lib/functions.php');
$db = new plantopia();

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];
    $db->delete_product_data($delete_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>

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
    <h1><i class="fa-solid fa-bars icon" style="color: green;"></i>Products </h1>
    <a href="viewproducts.php?excel_export">Excel Report</a>
    <table class="table ">
        <thead>
            <th>Sr No.</th>
            <th>Product</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Slider No.</th>
            <th>Date</th>
            <th>Time</th>
            <th>Operation</th>
            <th>Operation</th>
        </thead>
        <?php
            $data =array();
            $data = $db->displayproducts();

            $counter = 0;
            foreach($data as $record)
            {
                $p_id              =        $data[$counter]['p_id'];
                $pro_name          =        $data[$counter]['pro_name'];
                $pro_price         =        $data[$counter]['pro_price'];
                $pro_category      =        $data[$counter]['pro_category'];
                $pro_slider        =        $data[$counter]['pro_slider'];
                $pro_image         =        $data[$counter]['pro_image'];
                $date              =        $data[$counter]['date'];
                $time              =        $data[$counter]['time'];

               ?>
            <tr>
                <td><?php echo $counter+1;?></td>
                <td><img src="<?php echo $pro_image;?>" width="100px" height="100px"></td>
                <td><?php echo $pro_name;?></td>
                <td>Rs <?php echo $pro_price;?>/-</td>
                <td><?php echo $pro_category;?></td>
                <td><?php echo $pro_slider;?></td>
                <td><?php echo $date?></td>
                <td><?php echo $time?></td>
                <td><a href="editproducts.php?edit_id=<?php echo $p_id;?>">Edit</a></td>
                <td><a href="viewproducts.php?delete_id=<?php echo $p_id;?>">Delete</a></td>
            </tr>
            <?php
                

                $counter++;
                
            }
            ?>
        <?php
        if(isset($_GET['excel_export']))
            {
                $filename = "viewproducts".date('Ymd') . ".xls";			
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