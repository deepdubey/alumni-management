<?php 
    require_once ('../dbConn.php');
    $loginError = $formEmail= $formPass = $_SESSION['adminData'] = "";
	  if( isset( $_POST['submit'] ) ) {
    
    // build a function to validate data
    function validateFormData( $formData ) {
        $formData = trim($formData);
        $formData = stripslashes($formData);
        $formData = htmlspecialchars($formData);
        return $formData;
    }
    
    // create variables
    // wrap the data with our function
    $formPass = validateFormData( $_POST['password'] );
    
    // connect to database

    // create SQL query
    $query = "SELECT password FROM students WHERE  email='collegewebsite123@gmail.com'";
    
    // store the result
    $result = $conn -> query($query);
    if( $result -> num_rows > 0 ) {
        
      // store basic user data in variables
      while( $row = $result -> fetch_assoc() ) {
          $hashedPass = $row['password'];
      }
      
      // verify hashed password with the typed password
      if( password_verify( $formPass, $hashedPass ) ) { 
        session_start();
        $_SESSION['adminData'] = 'Admin Logged go';
        header('Location: admin.php');
      }else { // hashed password didn't verify
          
          // error message
          $loginError = "<div class='error-alert'><p>Wrong password. Try again.</p></div>";
          
      }
    }       
}?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>www.vcetavahan.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <style>
  body {
    background-image: url("../../img/books.png");
    background-size: cover;
  }
  </style>
</head>

<body>
  <h1>Login to Admin Panel</h1><br>
  <div class="password-only">
    <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
      <input style="padding:10px" type="password" name="password" placeholder="Password" required>
      <input style="padding:10px" type="submit" value="Submit" name="submit">
    </form>
  </div>
  <div style="color:red"><?php echo $loginError;?></div>
</body>

</html>