<?php require_once('lib/functions.php');?>
<header class="cstm-header" style="z-index: 9999999999999999999999999999999 !important;">
    <div class="logo"> Admin <span> Panel </span></div>


    <nav class="navbar">
            <a href="index.php">home</a>
            <a href="index.php#features">features</a>
            <a href="index.php#products">products</a>
            <a href="index.php#categories">categories</a>
            <a href="index.php#review">review</a>
        </nav>

    
        <div class="admin-pic" id = "admin-pic" style="width: 40px !important;">
      <img src="images/user.png" class="user-pic" onclick="toggleMenu()">
      </div>


                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                      <div class="user-info">
                          <img src="images/user.png">
                          <?php
                          $username = $_SESSION['admin_mobile_no'];?>
                          <h2 style="font-size: 20px;"><?php echo $username;?></h2>
                      </div>
                      <hr>


                      <a href="index.php?logout" class="sub-menu-link">
                          <img src="images/logout.png" style="font-size: 25px !important;">
                          <p style="font-size: 15px !important; color: black;">Logout</p>
                          <span>> </span>
                      </a>
                    </div>
                </div>




</header>