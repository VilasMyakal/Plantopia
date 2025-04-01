<?php
require_once('lib/functions.php');
$db = new plantopia();


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



if(isset($_GET['checkout']))
{
    if(! isset($_SESSION['login_mobile_no']))
  {
    ?>
    <script>
      alert("Please Log-In First...");
      window.location = "index.php";
    </script>
    <?php
  }
  else
  {
  ?>
  <script>
  window.location = "payment-gateway.php";
  </script>
  <?php
  }
}


if(isset($_POST['done-payment']))
{

    if($_POST['user_captcha']!=$_POST['system_captcha'])
    {
    ?>
    <script>
        alert("Invalid Captcha!! Please Enter Valid Captcha!!");
        window.location = "payment-gateway.php";
    </script>
    <?php
    }
    else
    {

    $full_name = $_POST['full_name'];
    $mobile_no = $_POST['mobile_no'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $total = $db->carttotal();
    $db->all_orders($full_name,$mobile_no,$address,$city,$zipcode,$total);


    $cart_data = array();

    $cart_data = $db->showmycartdetails();
    $counter = 0;
    foreach($cart_data as $record)
    {
        $p_image  =  $cart_data[$counter]['p_image'] ;
        $p_name   =  $cart_data[$counter]['p_name'] ;
        $quantity =  $cart_data[$counter]['quantity'] ;
        $p_price  =  $cart_data[$counter]['p_price'] ;


        $db->insert_confirm_orders($p_image,$p_name, $quantity,$p_price,$mobile_no);

        $counter++;
    }

    ?>
    <script>
        alert("!! Time to celebrate! Your order is confirmed !! You can continue shopping !!");
        window.location = "index.php";
      </script>
     <?php
     }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment-Gateway</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>


    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/style.css?v=2" >
    <link rel="stylesheet" href="css/payment-gateway.css?v=3" >
    <link rel="stylesheet" href="css/profile-design.css">

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.js"></script>

    <style>
html
{
    font-size: 100%;
}
    </style>
</head>
<body>

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
        <div class="fa-solid fa-bell" id="notify-btn" onclick= "toggleNotification()"><span><?php echo $notifications;?></span></div>
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
      <img src="images/user.png" class="user-pic" onclick="toggleMenu()">
      </div>


          <div class="sub-menu-wrap" id="subMenu">
              <div class="sub-menu">
                      <div class="user-info">
                          <img src="images/user.png">
                          <?php
                          $mobile_no = $_SESSION['login_mobile_no'];
                          $username = $db->returnusername($mobile_no);?>
                          <h2 style="font-size:25px;"><?php echo $username;?></h2>
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

</header>


<section class="features" style="margin-top: 100px;">
<div class="paymentcontainer" >

<form action="payment-gateway.php" method="POST">

    <div class="row">

        <div class="col">

            <h3 class="title">BILLING ADDRESS</h3>
            <div class="inputBox">
                <span>Total Amount: Rs <?php 
                $total = $db->carttotal();
                echo $total;
                ?>/-</span>
            </div>
            <div class="inputBox">
                <span>full name :</span>
                <input type="text" required name = "full_name" placeholder="full name">
            </div>
            <div class="inputBox">
                <span>mobile no :</span>
                <input type="text" required name="mobile_no" placeholder="mobile number">
            </div>
            <div class="inputBox">
                <span>address :</span>
                <input type="text" required name = "address" placeholder="enter address">
            </div>
            <div class="inputBox">
                <span>city :</span>
                <input type="text" required name = "city" placeholder="enter your city">
            </div>

            <div class="flex">
                <div class="inputBox">
                    <?php
                    $systemcaptcha = rand(5000,60000);
                    ?>
                    <span>Captcha-: <input style="border:none; background:white; border-bottom: 1px solid #eee;" type="text" value="<?php echo $systemcaptcha;?>" name="system_captcha" readonly></span>
                    <input type="text" name="user_captcha" placeholder="Enter Captcha" required>
                </div>
                <div class="inputBox">
                    <span>zip code :</span>
                    <input type="text" required name = "zipcode" placeholder="123 456">
                </div>
            </div>

        </div>

        <div class="col">

            <h3 class="title">PAYMENT</h3>
            
            <div class="inputBox">
                <span>cards accepted :</span>
                <img src="images/card_img.png" alt="">
            </div>
            <div class="inputBox">
                <span>name on card :</span>
                <input type="text" placeholder="mr. name">
            </div>
            <div class="inputBox">
                <span>credit card number :</span>
                <input type="number" placeholder="0000-0000-0000-0000">
            </div>
            <div class="inputBox">
                <span>exp month :</span>
                <input type="text" placeholder="month">
            </div>

            <div class="flex">
                <div class="inputBox">
                    <span>exp year :</span>
                    <input type="number" placeholder="year">
                </div>
                <div class="inputBox">
                    <span>CVV :</span>
                    <input type="text" placeholder="1234">
                </div>
            </div>

        </div>

    </div>

    <input type="submit" value="Done Payment" name="done-payment" class="btn">

</form>

</div>  
        </section>


<?php
require_once("footer.php");
?>

<script type = "text/javascript" src="js/profile.js?v=2"></script>
<script type = "text/javascript" src="js/script.js?v=2"></script>


</body>
</html>