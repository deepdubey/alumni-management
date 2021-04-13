<?php

$loginError = $formEmail= $formPass = "";

if( isset( $_POST['login'] ) ) {
    
    // build a function to validate data
    function validateFormData( $formData ) {
        $formData = trim($formData);
        $formData = stripslashes($formData);
        $formData = htmlspecialchars($formData);
        return $formData;
    }
    
    // create variables
    // wrap the data with our function
    $formEmail = validateFormData( $_POST['email'] );
    $formPass = validateFormData( $_POST['password'] );
    
    // connect to database
    include('dbConn.php');
    
    // create SQL query
    $query = "SELECT id, email, password FROM students WHERE email='$formEmail'";
    
    // store the result
    $result = $conn -> query($query );
    
    // verify if result is returned
    if( $result -> num_rows > 0 ) {
        
        // store basic students data in variables
        while( $row = $result -> fetch_assoc() ) {
            $email      = $row['email'];
            $id      = $row['id'];
            $hashedPass = $row['password'];
        }
        
        // verify hashed password with the typed password
        if( password_verify( $formPass, $hashedPass ) ) {
            
            // correct login details!
            // start the session
            session_start();
            
            // store data in SESSION variables
            $_SESSION['loggedInId'] = $id;
            $_SESSION['loggedInEmail'] = $email;
            header("Location: /Alumni");
        
        } else { // hashed password didn't verify
            
            // error message
            $loginError = "<div class='error-alert'><p>Wrong username / password combination. Try again.</p></div>";
            
        }
        
    } else { // there are no results in database
        
        $loginError = "<div class='error-alert'><p>No such user. Please Create Account.</p></div>";
        
    }
    
    // close the mysql connection
    $conn -> close();
    
}

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
<link rel="stylesheet" href="../css/login.css">
<link rel="shortcut icon" href="../img/chessfree.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<style>
  body{
    background-image: url("../img/books.png");
    background-size: cover;
  }
</style>
<body id="myPage">

  <!-- Navbar -->

  <header>
    <?php require_once('navbar.php'); ?>
  </header>
  <div class="login">

    <!-- <div class="fpart">
    				<div id="image">
    					<img src="../img/l.jpg">
    				</div>
    			</div> -->

    <div class="spart">
      <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
        <h2>Login</h2><br><br>
        <div id="inputwithicons">
          <i class="fa fa-envelope" aria-hidden="true"></i><input type="email" class="ip2" id="email" name="email"
            placeholder="Email" onblur="ValidateEmail()">
        </div>
        <br><br>
        <div id="inputwithicons">
          <i class="fa fa-lock"></i><input type="password" class="ip2" id="password" name="password"
            placeholder="Password" onblur="passid_validation()">
        </div>

        <?php echo $loginError; ?>
        <button type="submit" name="login">Login</button>
      </form>

      <div class="create">
        <h4>Not a member!</h4>
        <a href="signup.php"><button type="button">Create Account</button></a>
      </div>
    </div>

  </div>

  <script src="../js/main.js"></script>
  <script async type="text/javascript"
    src="//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/2a489a6d42a4b8e667c6d5aa54176aa6b72b4bfa9e8c92b17af5f7b493dd17bc.js">
  </script>
</body>

</html>