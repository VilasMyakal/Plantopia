
<!-- New product Input  -->


<?php

require_once('lib/functions.php');
$db = new plantopia();

if(isset($_POST['add_product']))
{

  $p_name = $_POST['product_name'];
  $p_price = $_POST['product_price'];
  $p_category = $_POST['p_category_name'];
  $p_slider = $_POST['slider_number'];
  
  
//  print_r($_FILES['p_image']);


  $p_image = $_FILES['p_image']['name'];
  $p_tmp_name = $_FILES['p_image']['tmp_name'];
  $p_folder = "images/".$p_image;

  move_uploaded_file($p_tmp_name,$p_folder);

$db->add_new_product($p_name, $p_price, $p_category,  $p_slider, $p_folder );

?>
<script>
    alert("Product added Succesfully!!");
    window.location = "viewproducts.php";
</script>
<?php
}

?>

<!-- New product Input  -->







<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

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
 <!-- product modal start -->
<style>
  /* View Products Page  */


.cstm_add_product_container
{
    padding: 50px;
    border-radius: 10px;
    background: white;
    width: 75%;
    margin-top: 10%;
    margin-left: 10%;
    box-sizing: content-box;
}
.cstm_modal_content
{
    padding: 20px 0px !important;
}

.cstm_modal_content label
{
    padding: 5px;
}


.cstm_add_product_container h1
{
    text-transform: capitalize;
    text-align: center;
    margin-bottom: 35px;
    font-size: 35px;
    padding: 10px 5px;
    text-decoration: none;
    color: rgb(61, 39, 59);
    border-bottom: 2px solid #77dd77;
}
.cstm_add_product_container h1 i
{
    padding-right: 10px;
}


</style>


</head>
<body>





  

<?php
require_once("admin-header.php");
?>




  <div class="container cstm_add_product_container">
  <h1><i class="fa-solid fa-bars icon" style="color: green;"></i>Add Products </h1>
   <form action="addproduct.php" method="POST" enctype="multipart/form-data">
          <div class="form-group cstm_modal_content">
            <input type="text" class="form-control" name="product_name" required placeholder="Product Name-: ">
          </div>

          <div class="form-group cstm_modal_content">
            <input type="number" class="form-control" name="product_price" required placeholder="Enter Price-: ">
          </div>

          <div class="form-group cstm_modal_content">
          <select name="p_category_name" required class="form-control " id="">
                 <option  >Select Category of Product</option>
            <?php
            
           
                $data =array();
                $data = $db->returnCategories();
                
                $counter = 0;
                foreach($data as $record)
                {
                    $Cat_Name= $data[$counter]['Cat_Name'];
                ?>
           
                  <option value="<?php echo $Cat_Name;?>"><?php echo $Cat_Name;?></option>
            
                <?php
                    $counter++;
                    }
            ?>
            
           
            
          </select>
          </div>

          <div class="form-group cstm_modal_content">
          <select name="slider_number" required class="form-control ">
            <option  >Select slider number of Product-slider</option>
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
          </div>

          <div class="form-group cstm_modal_content">
            <label for="p_image">Choose an image of your Product:</label><br>
            <input type="file" name = "p_image" required >
          </div>

          <div class="modal-footer">

                    
                    <button type="submit" class="btn btn-primary" name="add_product"  style="background-color:#77dd77; padding: 5px 30px;font-size:20px;">Add </button>

         </div>

    </form>
  </div>

 




<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script type = "text/javascript" src="js/profile.js?v=2"></script>


</body>
</html>
