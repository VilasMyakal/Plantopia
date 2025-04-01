<?php

require_once('lib/functions.php');
$db = new plantopia();

error_reporting(0);

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];
    $db->delete_notification($delete_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Notification</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>


    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/adminstyle.css">
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
    <h1><i class="fa-solid fa-bell" style=" color: green;"></i>Notifications </h1>
    <a href="viewnotifications.php?excel_export">Excel Report</a>


    <table class="table ">
       
        <thead>
            <th>SrNo.</th>
            <th>Topic Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Time</th>
            <th>Operation</th>
        </thead>
        <tbody>
            <?php
            $data =array();
            $data = $db->return_notifications();

            $counter = 0;
            foreach($data as $record)
            {
                $noti_id            =   $data[$counter]['noti_id']          ;
                $noti_topic         =   $data[$counter]['noti_topic']       ;
                $noti_description   =   $data[$counter]['noti_description'] ;
                $noti_date          =   $data[$counter]['noti_date']        ;
                $noti_time          =   $data[$counter]['noti_time']        ;

               ?>
               
               <tr>
                
                <td><?php echo $counter+1 ;     ?></td>
                <td><?php echo $noti_topic ;      ?></td>
                <td><?php echo $noti_description ;      ?></td>
                <td><?php echo $noti_date ;      ?></td>
                <td><?php echo $noti_time ;      ?></td>
                <td>
                    <a href="viewnotifications.php?delete_id=<?php echo $noti_id; ?>">Delete</a>
                </td>                               
                </tr>
                
                
                <?php
                

                $counter++;
                
            }
            ?>
        <?php
        if(isset($_GET['excel_export']))
            {
                $filename = "viewnotifications".date('Ymd') . ".xls";			
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