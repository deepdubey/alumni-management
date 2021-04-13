<?php
	include "dbConn.php";
	$email = $password = $message = $emailError = $passwordError = $cpasswordError = $collegeError = $confirmed_password = "";

	if( isset($_POST['login']) ){
		function validateFormData($formData){
			$formData = trim( stripslashes( htmlspecialchars( $formData ) ) );
			return $formData;
		}

    $bytes = random_bytes(16);
        
    $id = bin2hex($bytes);

		if( !$_POST['email'] ){
			$emailError = "<div class='error-alert'><p>Please enter email</p></div>";
		}else{
			$emailData = validateFormData( $_POST['email'] );
			if( !filter_var($emailData, FILTER_VALIDATE_EMAIL) ){
				$emailError = "<div class='error-alert'><p>Please enter valid email</p></div>";
			}

			$query = "SELECT email FROM students WHERE email='$emailData'";
			$result = $conn->query($query);

			if( $result -> num_rows > 0){
				$emailError = "<div class='error-alert'><p>Email already exist.You already signed up.</p></div>";
			}else{
				$email = $emailData;
			}	
		}

		$passwordData = validateFormData( $_POST['password'] );
		//ctype_alnum($passwordData) && strlen($passwordData)>=8 && preg_match('/a-z/', $passwordData) && preg_match('/A-Z/',$passwordData) && preg_match('/0-9/', $passwordData)
		if( !$_POST['password'] ){
			$passwordError = "<div class='error-alert'><p>Please enter password</p></div>";
		}else{
			if( !(preg_match("#[a-z]+#", $passwordData) && preg_match("#[0-9]+#", $passwordData) && strlen($passwordData) >= 8 ) ){
				$passwordError = "<div class='error-alert'><p>Password must contain atleast 8 character and combination of characters and numbers</p></div>";
			}else{
				$password = password_hash( $passwordData, PASSWORD_DEFAULT );
			}
		}

		if( !$_POST['cpassword'] ){
			$cpasswordError = "<div class='error-alert'><p>Please retype password</p></div>";
		}else{
			$confirmed_password = validateFormData( $_POST['cpassword'] );
			if( $confirmed_password != ( $password || $passwordData) ){
				$cpasswordError = "<div class='error-alert'><p>Password do not match.Please type carefully</p></div>";
			}
		}

		if( $email && $password ){
			$query = "INSERT INTO students(id, email, password) VALUES('$id', '$email','$password');";
			$result = $conn->query($query);
			if( $result ){
				$message = "<div class='error-alert'><p>You successfully signed up & logged in. Check your profile.</p></div>";
				session_start();
				$_SESSION['studentsData'] = $message;
				$_SESSION['loggedInId'] = $id;
        $_SESSION['loggedInEmail'] = $email;
				header( "Location: ../index.php" );
			}else{
				echo "Error: ". $query ." ". $conn -> error;
			}
		}

	}
?>

<!DOCTYPE html>
<html>
<title>Signup Form</title>
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
body {
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
        <h2 style="margin-left: 8%">Create account</h2><br><br>
        <div id="inputwithicons">
          <i class="fa fa-envelope" aria-hidden="true"></i><input type="email" id="email" name="email"
            placeholder="youremail@email.com" onblur="ValidateEmail()">
        </div>
        <span id="emailerror"></span>
        <br><br>
        <div id="inputwithicons">
          <i class="fa fa-lock"></i><input type="password" id="password" name="password" placeholder="Password"
            onblur="passid_validation()">
        </div>
        <span id="passworderror"></span>
        <br><br>
        <div id="inputwithicons">
          <i class="fa fa-lock"></i><input type="password" id="cpassword" name="cpassword"
            placeholder="Confirm password" onkeyup='check_pass();'>
        </div>
        <span id="cpassworderror"></span>
        <br>

        <?php if($emailError ) { ?>
        <p><?php echo $emailError ?></p>
        <?php }else if($passwordError){ ?>
        <p><?php echo $passwordError ?></p>
        <?php }elseif($cpasswordError) {?>
        <p><?php echo $cpasswordError ?></p>
        <?php }else{?>
        <p><?php echo $message ?>
          <?php } ?>
          <button type="submit" id="submit" name="login" disabled>Sign up</button>
      </form>
    </div>
  </div>
  <script src="../js/validator.js?v=1"></script>

  <script src="../js/main.js"></script>
  <script async type="text/javascript"
    src="//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/2a489a6d42a4b8e667c6d5aa54176aa6b72b4bfa9e8c92b17af5f7b493dd17bc.js">
  </script>
</body>

</html>