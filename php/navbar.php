<?php 
  error_reporting(0);
  session_start();
?>
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme-d2 w3-left-align">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2"
      href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
    <a href="/Alumni" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Home</a>
    <a href="news.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">College News</a>
    <a href="alumni.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Our Alumni</a>
    <a href="opportunity.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Opportunities</a>
    <a href="/Alumni/#contact" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
    <?php 
        if( isset($_SESSION['loggedInId']) ){ ?>

    <a href="profile.php"
      class="w3-bar-item w3-button w3-hide-small w3-hover-white"><?php echo $_SESSION['loggedInEmail']; ?></a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button" title="Notifications">Profile<i class="fa fa-caret-down"></i></button>
      <div class="w3-dropdown-content w3-card-4 w3-bar-block">
        <a href="profile.php" class="w3-bar-item w3-button">Profile</a>
        <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
      </div>
    </div>
    <?php  }else{ ?>
    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal" title="Search"><i
          class="fa fa-search"></i></a> -->
    <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Login & SignUp</a>
    <?php } ?>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium">
    <?php 
        if( isset($_SESSION['loggedInId'] )){ ?>
    <a href="./php/profile.php" class="w3-bar-item w3-button">Profile</a>
    <a href="./php/logout.php" class="w3-bar-item w3-button">Logout</a>
    <?php  }else{ ?>
    <a href="./php/login.php" class="w3-bar-item w3-button">Login & SignUp</a>
    <?php } ?>

    <a href="./php/news.php" class="w3-bar-item w3-button">College News</a>
    <a href="./php/alumni.php" class="w3-bar-item w3-button">Our Alumni</a>
    <a href="./php/opportunity.php" class="w3-bar-item w3-button">Opportunities</a>
    <a href="/Alumni/#contact/Alumni#" class="w3-bar-item w3-button">Contact</a>

  </div>
</div>