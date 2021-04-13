<?php 
session_start();
// error_reporting(0);
?>
<!DOCTYPE html>
<html>
<title>College</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/style.css">

<body id="myPage">

  <!-- Sidebar on click -->
  <nav class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left w3-xxlarge" style="display:none;z-index:2"
    id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()"
      class="w3-bar-item w3-button w3-display-topright w3-text-teal">Close
      <i class="fa fa-remove"></i>
    </a>
    <a href="#" class="w3-bar-item w3-button">Link 1</a>
    <a href="#" class="w3-bar-item w3-button">Link 2</a>
    <a href="#" class="w3-bar-item w3-button">Link 3</a>
    <a href="#" class="w3-bar-item w3-button">Link 4</a>
    <a href="#" class="w3-bar-item w3-button">Link 5</a>
  </nav>

  <!-- Navbar -->
  <div class="w3-top">
    <div class="w3-bar w3-theme-d2 w3-left-align">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2"
        href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
      <a href="/Alumni" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Home</a>
      <a href="./php/news.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">College News</a>
      <a href="./php/alumni.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Our Alumni</a>
      <a href="./php/opportunity.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Opportunities</a>
      <a href="#contact" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Contact</a>
      <?php 
        if( isset($_SESSION['loggedInId'] )){ ?>

      <a href="./php/profile.php"
        class="w3-bar-item w3-button w3-hide-small w3-hover-white"><?php echo $_SESSION['loggedInEmail']; ?></a>
      <div class="w3-dropdown-hover w3-hide-small">
        <button class="w3-button" title="Notifications">Profile<i class="fa fa-caret-down"></i></button>
        <div class="w3-dropdown-content w3-card-4 w3-bar-block">
          <a href="./php/profile.php" class="w3-bar-item w3-button">Profile</a>
          <a href="./php/logout.php" class="w3-bar-item w3-button">Logout</a>
        </div>
      </div>
      <?php  }else{ ?>
      <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-teal" title="Search"><i
          class="fa fa-search"></i></a> -->
      <a href="./php/login.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Login & SignUp</a>
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
      <a href="#contact" class="w3-bar-item w3-button">Contact</a>

    </div>
  </div>

  <!-- Image Header -->
  <div class="w3-display-container w3-animate-opacity">
    <img src="./img/college.jpg" alt="boat" style="width:100%;height:100vh;opacity: 0.5">
    <div class="w3-container w3-display-bottomleft w3-margin-bottom">
      <h1 class="" title="Go To W3.CSS" style="
    font-size: 50px;
">Vidyavardhini's College of Engineering and Technology</h1>
    </div>
  </div>

  <!-- Modal -->
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-top">
      <header class="w3-container w3-teal w3-display-container">
        <span onclick="document.getElementById('id01').style.display='none'"
          class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
        <h4>Oh snap! We just showed you a modal..</h4>
        <h5>Because we can <i class="fa fa-smile-o"></i></h5>
      </header>
      <div class="w3-container">
        <p>Cool huh? Ok, enough teasing around..</p>
        <p>Go to our <a class="w3-text-teal" href="/w3css/default.asp">W3.CSS Tutorial</a> to learn more!</p>
      </div>
      <footer class="w3-container w3-teal">
        <p>Modal footer</p>
      </footer>
    </div>
  </div>


  <!-- Contact Container -->
  <div class="w3-container w3-padding-64 w3-theme-l5" id="contact">
    <div style="text-align: center" class="w3-row">
      <!-- <div class="w3-col m5"> -->
      <div class="w3-padding-16"><span class="w3-xlarge w3-border-teal w3-bottombar">Contact Us</span></div>
      <h3>Address</h3>
      <p>Vidyavardhini's College of Engineering and Technology</p>
      <p><i class="fa fa-map-marker w3-text-teal w3-xlarge"></i>Vasai West</p>
      <p><i class="fa fa-phone w3-text-teal w3-xlarge"></i>  +91 1515151515</p>
      <p><i class="fa fa-envelope-o w3-text-teal w3-xlarge"></i>  test@test.com</p>
      <!-- </div> -->
      <!-- <div class="w3-col m7">
        <form class="w3-container w3-card-4 w3-padding-16 w3-white" action="/action_page.php" target="_blank">
          <div class="w3-section">
            <label>Name</label>
            <input class="w3-input" type="text" name="Name" required>
          </div>
          <div class="w3-section">
            <label>Email</label>
            <input class="w3-input" type="text" name="Email" required>
          </div>
          <div class="w3-section">
            <label>Message</label>
            <input class="w3-input" type="text" name="Message" required>
          </div>
          <input class="w3-check" type="checkbox" checked name="Like">
          <label>I Like it!</label>
          <button type="submit" class="w3-button w3-right w3-theme">Send</button>
        </form>
      </div> -->
    </div>
  </div>

  <!-- Image of location/map -->
  <!-- <img src="https://www.w3schools.com/w3images/map.jpg" class="w3-image w3-greyscale-min" style="width:100%;"> -->

  <!-- Footer -->
  <footer class="w3-container w3-padding-32 w3-theme-d1 w3-center">
    <h4>Follow Us</h4>
    <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Facebook"><i class="fa fa-facebook"></i></a>
    <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Twitter"><i class="fa fa-twitter"></i></a>
    <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Google +"><i
        class="fa fa-google-plus"></i></a>
    <a class="w3-button w3-large w3-teal" href="javascript:void(0)" title="Google +"><i class="fa fa-instagram"></i></a>
    <a class="w3-button w3-large w3-teal w3-hide-small" href="javascript:void(0)" title="Linkedin"><i
        class="fa fa-linkedin"></i></a>
    <p>Copyright <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">VCET</a></p>

    <div style="position:relative;bottom:100px;z-index:1;" class="w3-tooltip w3-right">
      <span class="w3-text w3-padding w3-teal w3-hide-small">Go To Top</span>
      <a class="w3-button w3-theme" href="#myPage"><span class="w3-xlarge">
          <i class="fa fa-chevron-circle-up"></i></span></a>
    </div>
  </footer>

  <script src="./js/main.js"></script>
  <script async type="text/javascript"
    src="//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/2a489a6d42a4b8e667c6d5aa54176aa6b72b4bfa9e8c92b17af5f7b493dd17bc.js">
  </script>

</body>

</html>