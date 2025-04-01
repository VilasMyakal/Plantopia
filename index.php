<?php

require_once('lib/functions.php');
$db = new plantopia();
$current_path = getCurrentUrl();

error_reporting(0);


if($current_path == "http://localhost/")
  {
    $db->deleteallcart(0);
    session_unset();
  }


if(isset($_GET['logout']))
{
  session_unset();
  ?>
  <script>
    alert("You are Logged Out!!")
    window.location = "http://localhost/";
  </script>
  <?php
}

if(isset($_POST['sign_up_btn']))
{
  $full_name = $_POST['full_name'];
  $mobile_number = $_POST['mobile_number'];
  $password = $_POST['password'];
  $db->user_data($full_name,$mobile_number,$password);


  // $whatsapp_message = "
	// 			💥💥💥💥💥💥💥💥 \n

	// 			*DREAM TECHNOLOGY*

	// 			Dear $full_name,
	// 			Thank You For Joining With Us \n
  //       We will provide the best plants for lowest price\n
  //       So, Don't forgot to buy beutiful plants from our website!!\n

	// 			\n Note:Automatic Software Message".
	// 			"\n💥💥💥💥💥💥💥💥";

	// 			$url =	"http://web.cloudwhatsapp.com/wapp/api/send?apikey=77c7d93183944f0c99b531c6b9705e75&mobile=$mobile_number&msg=".urlencode($whatsapp_message);
	// 				echo $response = file_get_contents($url);
					

}


if(isset($_POST['sign_in_btn']))
{
  $mobile_no = $_POST['mobile_number'];
  $userpassword = $_POST['password'];
  $myadmin = $db->checkMyAdmin($mobile_no,$userpassword);
  if($myadmin !="")
  {
    $_SESSION['admin_mobile_no'] = $myadmin;
    ?>
    <script>
      window.location = "admin-panel.php";
    </script>
    <?php

  }
  else
  {
  $password = $db->checkMobileNumber($mobile_no);

  if($password=="")
  {
  ?>
  <script>
    alert("This user is not registered with us. Check Mobile Number");
    window.location = "index.php";
  </script>
  <?php
  }
  else
  {
    if($password==$userpassword)
    { 
      session_unset();
      $_SESSION['login_mobile_no'] = $mobile_no;
      ?>
      <script>
        window.location = "index.php";
      </script>
      <?php
    }
    else
    {
      session_unset();
      ?>
      <script>
          alert("Incorrect password");
           window.location = "index.php";

      </script>
      <?php
    }
  }
}


}


if(isset($_GET['add_to_cart_id']))
{

  $add_to_cart_id   = $_GET['add_to_cart_id'];

  $value = $db->CheckMyCart_idExist($add_to_cart_id);//if exist then set to 1 and if not set to 0

  if($value != 1)
  {
    $Cart_idDetail = $db->returnCart_idDetail($add_to_cart_id);
    if(!empty($Cart_idDetail))
    {
      
      $p_name     = $Cart_idDetail['Pro_Name'];
       $p_price    = $Cart_idDetail['Pro_Price'];
       $p_category = $Cart_idDetail['Pro_Category'];
       $p_image    = $Cart_idDetail['Pro_Image'];
      $p_quantity = "1";

      $db->add_My_Cart($p_name, $p_price, $p_category, $p_quantity ,$p_image, $add_to_cart_id );
      ?>
      <script>
        alert("Item Added!!");
        window.location = "index.php";
      </script>
      <?php
    }

    }
    else if($value == 1)
    {
    ?>
    <script>
      alert("Item Exist!!");
      window.location = "index.php";
    </script>
    <?php
  }

}





if(isset($_GET['cart_id']))
{
  $cart_id = $_GET['cart_id'];

  $db->deletecart($cart_id);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Plant selling website, Best Plants in india, Garden decor, gardening, indoor plants, outdoor plants, herbs plants, flowers, fruit"/>
    <meta name="description" content="The only plant market place that connects plant  lovers with independent micro nurseries, and side hustlers. Discover the magic of plants!"/>
    <meta name="robots" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantopia</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>


    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/style.css?v=2" >
    <link rel="stylesheet" type="text/css" href="css/profile-design.css">



    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
   
</head>
<body>

<!-- Code for Header-->
<header class="header" style="z-index: 9999999999999999999999999999999 !important;">
        <a href="#" class="logo"><i class="fa-sharp fa-solid fa-leaf"></i> Plantopia</a>

        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="index.php#features">features</a>
            <a href="index.php#products">products</a>
            <a href="index.php#categories">categories</a>
            <a href="index.php#review">review</a>
          
        </nav>
  




      <div class="icons">
        <?php
        $notifications = $db->count_notifications();
        $cart_count = $db->CountTotalCart();
        ?>
        <div class="fa fa-bars" id="menus-btn"></div>
        <div class="fa-solid fa-bell" id="notify-btn" onclick= "toggleNotification()"><?php    
                      if(isset($_SESSION['login_mobile_no']))
                      {
                      ?>
                        <span><?php echo $notifications; ?></span>
                      <?php
                      }
                      ?></div>
        <div class="fa fa-search" id="search-btn"></div>
        <div class="fa fa-shopping-cart" id="cart-btn"><span><?php echo $cart_count; ?></span></div>
        <div class="fa fa-user" id="login-btn"></div>
      </div>
      
      <?php
      if(isset($_SESSION['login_mobile_no']))
      {
        
      ?>
      <style>
      .header .icons #login-btn
      {
        display:none;
      }
      
      </style>
      <div class="admin-pic" id = "admin-pic" style="width: 40px !important;">
      <img src="images/user.png" alt="User Image"  class="user-pic" onclick="toggleMenu()">
      </div>


                  <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                      <div class="user-info">
                          <img src="images/user.png" alt="User Image">
                          <?php
                          $mobile_no = $_SESSION['login_mobile_no'];
                          $username = $db->returnusername($mobile_no);?>
                          <h2><?php echo $username;?></h2>
                      </div>
                      <hr>


                      <a href="index.php?logout" class="sub-menu-link">
                          <img src="images/logout.png" style="font-size: 25px !important;">
                          <p style="font-size: 15px !important; color: black;">Logout</p>
                          <span>> </span>
                      </a>
                    </div>
                </div>
            <?php
    }
    ?>

    

        <form action="searchproduct.php" method="POST"  class="search-form">
            <input type="search" id="search-box" name ="searched_product" placeholder="Search Here...">
            <label for="#search-box"><button style="background:none;" type="submit" name="search_button" class="fa fa-search "></button></label>
        </form>

        
    <div class="notification-page">
    <?php if(isset($_SESSION['login_mobile_no']))
      { ?>
            <div class="items">
              <?php 
              $notifications = array();
              $counter = 0;
              $notifications = $db->view_notification();

            foreach($notifications as $record)
            {
              $topic          =     $notifications[$counter]['topic']       ;
              $description    =     $notifications[$counter]['description'] ;
              $date           =     $notifications[$counter]['date']        ;
              $time           =     $notifications[$counter]['time']       ;
            
            ?>
                <div>
          <h3 style="font-weight: bolder; text-align: center; padding-top: 20px; "><?php echo $topic; ?></h3>
          <h4 style=" padding: 10px; margin: 5px; line-height: 18px;"> <?php echo $description; ?></h4>
        </div>

                <?php
              $counter++;  
              }
                ?>
        </div>
      <?php }
      else
      {
      ?>
        <h3>Purchase Plant or sign up to on Notification!!</h3> 
        <?php
      }?>
    </div>
  <!-- login form desining -->

  <div class="form_box">
    <div class="button_box">
        <div id="btn_sign_up"></div>
        <button type="button" class="toggle-btn" onclick="login()">Sign-In</button>
        <button type="button" class="toggle-btn" onclick="register()">Sign-Up</button>
    </div>
        <div class="social_media">
            <img src="images/icons8-facebook-575.png" alt="facebook" class="fb">
            <img src="images/instagram (1).png" class="it" alt="instragram">
            <img src="images/twiter.png" class="tw" alt="twiter">
        </div>
      <form action="index.php" method="post" class="login_form" id="login">
        <input type="text" name="mobile_number" class="form-field" placeholder="Enter Mobile No:" required/>
        <input type="password" name="password" class="form-field" placeholder="Enter Password" required/>
        <input type="checkbox" class="checkbox" />
        <span>Remember Password</span>
        <button type="submit" name="sign_in_btn" class="submit">Sign-In</button>
      </form>
      <form action="index.php" method="post" class="login_form" id="register">
        <input type="text" name="full_name" class="form-field" placeholder="Enter Fullname:" required/>
        <input type="text" name="mobile_number" class="form-field" placeholder="Enter Mobile No:" required/>
        <input type="password" name="password" class="form-field" placeholder="Enter Password:" required/>
        <input type="checkbox" class="checkbox" />
        <span>I Accept the Terms and condition</span>
        <input type="submit" class="submit" name="sign_up_btn" value="Sign-Up" />
      </form>
  </div>

      <!-- login form desining -->


    <!-- -------------------------------------------  -->
          
  <div class="shoping-cart" >
          <div class="items">

            <?php
            $cart = array();
            $c_counter=0;
            $total = 0;
            $cart = $db->MyCartProducts();
            
            if(empty($cart))
            {
              ?>
              <h2>Cart is Empty</h2>
              <?php
            }
            else
            {
            foreach($cart as $record)
            {
              
              $c_id           =       $cart[$c_counter]['p_id'] ;
              $c_name         =       $cart[$c_counter]['p_name'] ;
              $c_price        =       $cart[$c_counter]['p_price'] ;
              $c_image        =       $cart[$c_counter]['p_image'];
            
            ?>


              <div class="box">
                  <a href="index.php?cart_id=<?php echo $c_id; ?>" ><i class="fa fa-trash"></i></a>
                  <img src="<?php echo $c_image;?>" alt="cart image" >
                  <div class="content">
                      <h3> <?php echo $c_name;?> </h3>
                      <span class="price">Rs <?php echo $c_price;?>/- <input type="hidden" class="iprice" id="productprice" value= "<?php echo $c_price;?>"></span>
                      <span onmouseup="quantitychanged()" class="quantity">Qty : <input type="number"  class="iquantity" id="myquantity" min="1" max="10" value="1"></span>
                      <?php $total = $total + ($c_price);?>
                  </div>
              </div>
            
              <script language="javascript" type="text/javascript">

                  function quantitychanged(){

                    

                  var currentprice = Number(document.getElementById("Totalamount").value);
                  document.getElementById("Totalamount").value = ""+(currentprice);
                  var productprice = Number(document.getElementById("productprice").value);
                  var productquantity = Number(document.getElementById("myquantity").value);

                  //var currentTotal = currentprice-(productprice*productquantity);

                  currentprice = currentprice - (productprice);

                  productprice = productprice * productquantity;

                  currentprice = currentprice + productprice;
                  
                  alert(""+currentprice);

                  document.getElementById("Totalamount").value = ""+(currentprice);


                  }

              </script>
    
            

              <?php
              $c_counter++;}?>
              </div>
              <div class="total" id = "itotal" >Total Amount: Rs <input type="text" id="Totalamount" value=" "/>/-</div>
              <a href="payment-gateway.php?checkout" class="buy-btn"> Checkout </a>
              
              
              <?php }?>
          </div>

  <!-- shopping cart desining -->

</header>

<!--Code for the banner-->

<section class="cstm-carousel-position">
<div id="carouselExampleIndicators" class="carousel slide cstm-carousel" >
    <div class="carousel-indicators " >
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" ></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
      <div class="carousel-item active">
        <img src="images/carusel1.jpeg" alt="carousel" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/carusel1.jpeg" alt="carousel" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/carusel1.jpeg" alt="carousel" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

</section>
<!--Code for the banner-->


<!--Code for the Features-->
<section class="features" id="features">
 <h1 class="heading">Our <span>Features</span></h1>

 <div class="cstm-card-container">

  <div class="cstm-card">
    <img src="images/features-img-shipping-removebg-preview.png" alt="features image" class="features-img">
    <h3>Secure Shipping</h3>
    <p>Diligent care taken to deliver healthy plants.</p>
    <!-- <a href="" class="btn">Read more</a> -->
  </div>

  <div class="cstm-card">
    <img src="images/features-img-support-removebg-preview.png" class="features-img" alt="features image">
    <h3>We Support</h3>
    <p>We help you to grow your garden.</p>
    <!-- <a href="" class="btn">Read more</a> -->
  </div>

  <div class="cstm-card">
    <img src="images/features-img-packaging.png" class="features-img" alt="features image">
    <h3>Secured Packaging</h3>
    <p>We will pack it safely.</p>
    <!-- <a href="" class="btn">Read more</a> -->
  </div>

 </div>

</section>
<!--Code for the Features-->


<!--Code for the Product-->

<section class="products-section" id="products">
  <h1 class="heading">Our <span>Products</span></h1>
  
  <?php
            
            error_reporting(0);
             $Cat_data =array();
             $Cat_data = $db->returnCategories();
             
             $Cat_counter = 0;
             foreach($Cat_data as $record)
             {
                 $Cat_Name = $Cat_data[$Cat_counter]['Cat_Name'];
             ?>

    <div class="swiper product-slider">
        <div class="swiper-wrapper">
            
        <?php
                $slide1_data = array();
                $slide1_data = $db->displayallproductswithcategories1($Cat_Name);
                
                $counter = 0;
                foreach($slide1_data as $record)
                {
                    $P_id= $slide1_data[$counter]['P_id'];
                    $pro_name= $slide1_data[$counter]['pro_name'];
                    $pro_price=$slide1_data[$counter]['pro_price'];
                    $pro_image=$slide1_data[$counter]['pro_image'];
        ?>

                 <div class="swiper-slide cstm-card">
                    <img src="<?php echo $pro_image; ?>" alt="product image">
                    <h3><?php echo $pro_name; ?></h3>
                    <span class="price">Rs <?php echo $pro_price;?>/-</span>
                    <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                    </div>
                    <a href="index.php?add_to_cart_id=<?php echo $P_id;?>" class="btn">Add to Cart</a>
                  </div>
                  <?php
                    $counter++;
                    }
                    ?>
        </div>
    </div>
 <?php
 if($Cat_counter==0)
 {
  ?>
    <div class="swiper product-slider">
        <div class="swiper-wrapper">
            
        <?php
                $slide1_data =array();
                $slide1_data = $db->displayallproductswithcategories2($Cat_Name);
                
                $counter = 0;
                foreach($slide1_data as $record)
                {
                    $P_id= $slide1_data[$counter]['P_id'];
                    $pro_name= $slide1_data[$counter]['pro_name'];
                    $pro_price=$slide1_data[$counter]['pro_price'];
                    $pro_image=$slide1_data[$counter]['pro_image'];
        ?>

                 <div class="swiper-slide cstm-card">
                    <img src="<?php echo $pro_image; ?>" alt="product image">
                    <h3><?php echo $pro_name; ?></h3>
                    <span class="price">Rs <?php echo $pro_price;?>/-</span>
                    <div class="star">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                    </div>
                    <a href="index.php?add_to_cart_id=<?php echo $P_id;?>" class="btn">Add to Cart</a>
                  </div>
                  <?php
                    $counter++;
                    }
                    ?>
        </div>
    </div>
    <?php
  }
    ?>
    <?php
  $Cat_counter++;
  }
?>
</section>

<!--Code for the Product-->









<!--Code for the Categories-->

<section class="products-section" id="categories">
  <h1 class="heading">Products <span>Categories</span></h1>



  <div class="swiper product-slider">
              <div class="swiper-wrapper">

                <?php
                $data =array();
                $data = $db->returnCategories_detail();
                
                $counter = 0;
                foreach($data as $record)
                {
                  $Cat_Name=$data[$counter]['Cat_Name'];
                  $Cat_discount=$data[$counter]['Cat_discount'];
                  $Cat_image=$data[$counter]['Cat_image'];
                ?>

                  <div class="swiper-slide cstm-card">
                  <img src="<?php echo $Cat_image;?>" alt="category image" height=500px>
                  <h3><?php echo $Cat_Name;?> Plants</h3>
                  <p style="font-size: 20px;">Upto <?php echo $Cat_discount;?>% Off</p>
                  <a href="categories.php#<?php echo $Cat_Name;?>" class="btn">View Plants</a>
                  </div>
                  <?php
                    $counter++;
                    }
                    ?>
                </div>
      </div>            






</section>

<!--Code for the Categories-->






<!--Code for the Customer's Review-->


<section class="review" id="review">
  <h1 class="heading">Customer's <span>Reviews</span></h1>

  <div class="swiper review-slider">
    <div class="swiper-wrapper">
        <div class="swiper-slide cstm-card">
          <img src="images/rohitsharma.png" alt="users review">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta possimus maiores eius nisi doloribus! Explicabo facere optio magni nihil culpa?
          </p>
          <h3>Rohit Sharma</h3>
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
           </div>
        </div>
        <div class="swiper-slide cstm-card">
          <img src="images/ms dhoni.jfif" alt="users review">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta possimus maiores eius nisi doloribus! Explicabo facere optio magni nihil culpa?
          </p>
          <h3>M.S. Dhoni</h3>
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
           </div>
        </div>
        <div class="swiper-slide cstm-card">
          <img src="images/virat kohli.jfif" alt="users review" >
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta possimus maiores eius nisi doloribus! Explicabo facere optio magni nihil culpa?
          </p>
          <h3>Virat Kohli</h3>
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
           </div>
        </div>
        <div class="swiper-slide cstm-card">
          <img src="images/Roman Reigns.jfif" alt="users review">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta possimus maiores eius nisi doloribus! Explicabo facere optio magni nihil culpa?
          </p>
          <h3>Roman Reigns</h3>
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half"></i>
           </div>
        </div>
        <div class="swiper-slide cstm-card">
          <img src="images/great khali.jfif" alt="users review">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta possimus maiores eius nisi doloribus! Explicabo facere optio magni nihil culpa?
          </p>
          <h3>Great Khali</h3>
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
           </div>
        </div>
        
        
    </div>
  </div>



</section>


<!--Code for the Customer's Review-->
<?php
require_once("footer.php");
?>



<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script type = "text/javascript" src="js/script.js?v=2"></script>
<script type = "text/javascript" src="js/profile.js?v=2"></script>


</body>
</html>