<?php

require_once('lib/functions.php');
$db = new plantopia();
error_reporting(0);

if(isset($_GET['delete_id'] , $_GET['catname']))
{
    $delete_id = $_GET['delete_id'];
    $catname = $_GET['catname'];
    $db->delete_category_data($delete_id,$catname);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Categories</title>

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
    <h1><i class="fa-solid fa-folder-tree icon" style="color: green;"></i>Categories </h1>
    <a href="viewcategory.php?excel_export">Excel Report</a>


    <table class="table ">
        <thead>
            <th>Sr No.</th>
            <th>Category</th>
            <th>Name</th>
            <th>Discount</th>
            <th>Date</th>
            <th>Time</th>
            <th>Operation</th>
            <th>Operation</th>
        </thead>
        <tbody>
        <?php
            $data =array();
            $data = $db->DisplayCategories_detail();

            $counter = 0;
            foreach($data as $record)
            {
                $Cat_id           =         $data[$counter]['Cat_id'];
                $Cat_Name         =         $data[$counter]['Cat_Name'] ;
                $Cat_discount     =         $data[$counter]['Cat_discount'];
                $Cat_image        =         $data[$counter]['Cat_image'];
                $Date             =         $data[$counter]['Date'];
                $Time             =         $data[$counter]['Time'];

               ?>
            <tr>
                <td><?php echo $counter+1;?></td>
                <td><img src="<?php echo $Cat_image;?>" width="100px" height="100px"></td>
                <td><?php echo $Cat_Name;?></td>
                <td>Upto <?php echo $Cat_discount;?>%</td>
                <td><?php echo $Date?></td>
                <td><?php echo $Time?></td>
                <td><a href="editcategory.php?edit_id=<?php echo $Cat_id; ?>">Edit</a></td>
                <td><a href="viewcategory.php?delete_id=<?php echo $Cat_id; ?>&catname=<?php echo $Cat_Name; ?>">Delete</a></td>
            </tr>
            <?php
                

                $counter++;
                
            }
            ?>
        <?php
        if(isset($_GET['excel_export']))
            {
                $filename = "viewcategory".date('Ymd') . ".xls";			
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

        </tbody>
    </table>

  </section>











<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script type = "text/javascript" src="js/profile.js?v=2"></script>

</body>
</html>