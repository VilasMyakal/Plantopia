
<!-- Product Category Input  -->

<?php
require_once('lib/functions.php');
$db = new plantopia();



if(isset($_POST['add_category']))
{

    $category_name = $_POST['category_name'];
    $category_discount = $_POST['category_discount'];


    $c_image = $_FILES['category_image']['name'];
    $c_tmp_name = $_FILES['category_image']['tmp_name'];
    $c_folder = "images/".$c_image;
  
    move_uploaded_file($c_tmp_name,$c_folder);
  

    $db->category_data($category_name,$category_discount,$c_folder);


    ?>
    <script>
        alert("Category added Succesfully!!");
        window.location = "viewcategory.php";
    </script>
    <?php
    }
    
    ?>

<!-- Product Category Input  -->






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>

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

<style>


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
<h1><i class="fa-solid fa-folder-tree icon" style="color: green;"></i>Add Categories </h1>
<form action="addcategory.php" method="POST" enctype="multipart/form-data">
          <div class="form-group cstm_modal_content">
            <input type="text" class="form-control" name="category_name" required placeholder="Category Name-: ">
          </div>

          <div class="form-group cstm_modal_content">
            <input type="number" class="form-control" name="category_discount" required placeholder="Enter Discount-: ">
          </div>

          <div class="form-group cstm_modal_content">
            <label for="category_image">Select an image of your category-:</label>
            <br>
            <input type="file"  name="category_image" required>
          </div>

          <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary" name="add_category" style="background-color:#77dd77; padding: 5px 30px;font-size:20px;">Add </button>
         </div>

        </form>
</div>






<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
<script type = "text/javascript" src="js/profile.js?v=2"></script>


</body>
</html>
