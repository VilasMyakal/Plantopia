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

    

        <form class="search-form">
            <input type="search" id="search-box" placeholder="Search Here...">
            <label for="#search-box" class="fa fa-search"></label>
        </form>

        
    <div class="notification-page">
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
          <h3 style="font-weight: bold;"><?php echo $topic;?></h3>
          <h4 style="border: 0.2px solid gray; padding: 10px; margin: 5px;"><?php echo $description;?></h4>
        </div>

        <?php
      $counter++;  
      }
        ?>
     </div>
    </div>
  <!-- login form desining -->

  <div class="form_box">
    <div class="button_box">
        <div id="btn_sign_up"></div>
        <button type="button" class="toggle-btn" onclick="login()">Sign-In</button>
        <button type="button" class="toggle-btn" onclick="register()">Sign-Up</button>
    </div>
        <div class="social_media">
            <img src="images/icons8-facebook-575.png" class="fb">
            <img src="images/instagram (1).png" class="it">
            <img src="images/twiter.png" class="tw">
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
                  <img src="<?php echo $c_image;?>" >
                  <div class="content">
                      <h3> <?php echo $c_name;?> </h3>
                      <span class="price">Rs <?php echo $c_price;?>/- <input type="hidden" class="iprice" value= "<?php echo $c_price;?>"></span>
                      <span class="quantity">Qty : <input type="number" class="iquantity" min="1" max="10" value="1"></span>
                      <?php $total = $total + ($c_price);?>
                  </div>
              </div>
            
    
            

              <?php
              $c_counter++;}?>
              </div>
              <div class="total" id = "itotal">Total Amount: Rs <?php echo $total;?>/-</div>
              <a href="payment-gateway.php?checkout" class="buy-btn"> Checkout </a>
              
              
              <?php }?>
          </div>

  <!-- shopping cart desining -->

</header>