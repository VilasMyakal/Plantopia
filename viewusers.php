<?php

require_once('lib/functions.php');
$db = new plantopia();

if(isset($_GET['delete_id']))
{
    $delete_id = $_GET['delete_id'];
    $db->delete_user_sign_up_data($delete_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>

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
    <h1><i class="fa-solid fa-users" style=" color: green;"></i>Users </h1>
    <a href="viewusers.php?excel_export">Excel Report</a>


    <table class="table ">
       
        <thead>
            <th>Sr_No</th>
            <th>Full_Name</th>
            <th>Mobile No.</th>
            <th>Password</th>
            <th>Date</th>
            <th>Time</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?php
            $data =array();
            $data = $db->logined_users_data();

            $counter = 0;
            foreach($data as $record)
            {
                $res_id = $data[$counter]['Sr_No'];
                $Full_Name = $data[$counter]['Full_Name'];
                $Email_Id = $data[$counter]['Email_Id'];
                $Password = $data[$counter]['Password'];
                $Date = $data[$counter]['Date'];
                $Time = $data[$counter]['Time'];

               ?>
               
               <tr>
                
                <td><?php echo $counter+1 ;     ?></td>
                <td><?php echo $Full_Name ;      ?></td>
                <td><?php echo $Email_Id ;      ?></td>
                <td><?php echo $Password ;      ?></td>
                <td><?php echo $Date ;      ?></td>
                <td><?php echo $Time ;      ?></td>
                <td>
                    <a href="viewusers.php?delete_id=<?php echo $res_id; ?>">Delete</a>
                </td>                               
                </tr>
                
                
                <?php
                

                $counter++;
                
            }
            ?>
        <?php
        if(isset($_GET['excel_export']))
            {
                $filename = "viewusers".date('Ymd') . ".xls";			
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