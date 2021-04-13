<?php
	session_start();
  if( !isset($_SESSION['adminData']) ){
    header( "Location: getAllLogin.php" );
  }
	$Msg = '';
	require_once('../dbConn.php');
    $id = $_GET['id'];
    $sql = "SELECT fname, mname, lname, email, year, working, company, position, contact, linkedIn FROM alumni WHERE id='$id' ";
	
	$result0 = $conn -> query($sql);
    if(!$result0) die($conn -> error);
	$rows = $result0 -> fetch_assoc();
    

    if (isset( $_POST['save'] )) {
        function validateFormData( $formData ) {
            $formData = trim($formData);
            $formData = stripslashes($formData);
            $formData = htmlspecialchars($formData);
            return $formData;
        } 
 
        $fname = validateFormData($_POST['fname']);
        $mname = validateFormData($_POST['mname']);
        $lname = validateFormData($_POST['lname']);
        $email = validateFormData($_POST['email']);
        $year = validateFormData($_POST['year']);
        $working = validateFormData($_POST['working']);
        $company = validateFormData($_POST['company']);
        $position = validateFormData($_POST['position']);
        $contact = validateFormData($_POST['contact']);
        $linkedin = validateFormData($_POST['linkedin']); 


		$query = "UPDATE alumni SET fname='$fname', mname='$mname', lname='$lname', email='$email', year='$year', working='$working', company='$company', position='$position', contact='$contact', position='$position' WHERE id = '$id' ";
		$result = $conn -> query($query);
        if( $result ){
			$Msg = "Changes saved! Go back";
			// header( "Location: ./profile.php" );
        }else{
            $Msg = "Error: ". $query ." ". $conn -> error;
        }
    }

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="http://vcetalumni.ga/css/createAlumni.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<style>
body {
  background-image: url("../../img/books.png");
  background-size: cover;
}
</style>

<body>
  <h1>Edit Alumni</h1>
  <div class="login ">

    <form class="form" action="<?php echo htmlspecialchars('editAlumni.php?id='.$id)?>" method="post">
      <h2>Edit Details</h2>

      <?php if( $Msg ){ ?>
      <div class="success-alert">
        <p><?php echo $Msg ; ?></p>
      </div>
      <?php } ?>

      <table>

        <tr>
          <td>
            <h4>Full Name<span id="star">*</span></h4>
          </td>
          <td><input type="text" name="fname" placeholder="First Name" value="<?php echo $rows['fname']?>" required>
            <input type="text" name="mname" placeholder="Middle Name" value="<?php echo $rows['lname']?>" required>
            <input type="text" name="lname" placeholder="Middle Name" value="<?php echo $rows['mname']?>" required></td>
        </tr>

        <tr>
          <td>
            <h4>Email<span id="star">*</span></h4>
          </td>
          <td><input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              placeholder="youremail@email.com" value="<?php echo $rows['email']?>" required>
          </td>
        </tr>

        <tr>
          <td>
            <h4>Year of Passing<span id="star">*</span></h4>
          </td>
          <td><select id="year" name="year" value="<?php echo $rows['year']?>" required></select></td>
        </tr>

        <tr id="radioBtn">
          <td colspan="2">
            <div class="rb">
              <h3>Working</h3><input type="radio" id="groupA" name="working" value="Yes" required>
            </div>
            <div class="rb">
              <h3>Not Working</h3><input type="radio" id="groupB" name="working" value="No" required>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <h4>Company<span id="star">*</span></h4>
          </td>
          <td><input type="text" name="company" placeholder="Company in which you are working"
              value="<?php echo $rows['company']?>" required></td>
        </tr>

        <tr>
          <td>
            <h4>Position<span id="star">*</span></h4>
          </td>
          <td><input type="text" name="position" placeholder="Your post in that company"
              value="<?php echo $rows['position']?>" required></td>
        </tr>

        <tr>
          <td>
            <h4>Contact No<span id="star">*</span></h4>
          </td>
          <td><input type="tel" pattern="^\d{10}$" name="contact" required placeholder="only 10 digit allowed"
              value="<?php echo $rows['contact']?>"></td>
        </tr>

        <tr>
          <td>
            <h4>Linkedin Links<span id="star">*</span></h4>
          </td>
          <td><input type="text" name="linkedin" placeholder="linkedin" value="<?php echo $rows['linkedIn']?>" required>
        </tr>

      </table>
      <a href="getAlumni.php"><i class="fas fa-arrow-left"></i>Go back</a>
      <input type="submit" value="Save" class="btn" name="save"><br>
    </form>
  </div>
  <script>
  var start = 1990;
  var end = new Date().getFullYear();
  var options = "";
  for (var year = start; year <= end; year++) {
    options += "<option>" + year + "</option>";
  }
  document.getElementById("year").innerHTML = options;
  </script>
</body>


</html>