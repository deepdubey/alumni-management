<?php
    // error_reporting(0);
    session_start();
    if( !$_SESSION['loggedInId'] ){
        header( "Location: login.php" );
    }
    $fname = $mname = $lname = $email = $working = $others = $contact = $company = $successMsg = "";
    require_once('dbConn.php');

    if (isset( $_POST['submit'] )) {
        function validateFormData( $formData ) {
            $formData = trim($formData);
            $formData = stripslashes($formData);
            $formData = htmlspecialchars($formData);
            return $formData;
        }
        
        $id = $_SESSION['loggedInId'];
        
        $fname = validateFormData($_POST['fname']);
        $mname = validateFormData($_POST['mname']);
        $lname = validateFormData($_POST['lname']);
        $email = validateFormData($_POST['email']);
        $year = validateFormData($_POST['year']);
        $working = validateFormData($_POST['working']);
        $company = validateFormData($_POST['company']);
        $others = validateFormData($_POST['others']);
        $position = validateFormData($_POST['position']);
        $contact = validateFormData($_POST['contact']);
        $linkedIn = validateFormData($_POST['linkedIn']); 


        // SQL query to check if alumni is authenticate
        $queryValidAlumni = "SELECT name,email FROM added_alumni WHERE name LIKE '$fname%' AND email='$email' AND yop='$year'";
        $validAlumni = $conn -> query($queryValidAlumni);
        if( !$validAlumni -> num_rows > 0 ) {
          $successMsg = "You are not allowed to create alumni";
        }
        
        // SQL query to check id if already exist
        else{ 
          $sql = "SELECT id FROM alumni WHERE id='$id'";
          $getId = $conn -> query($sql);
          if( $getId -> num_rows > 0 ) {
            $successMsg = "You already created yourself as alumni. Check your profile";
          }
    
        else if( $fname && $mname && $lname && $email && $working && $contact  )
        {

          $query = "INSERT INTO alumni(id, fname, mname, lname, email, year, working, company, position, others, contact, linkedIn, createdOn) 
          VALUES( '$id', '$fname' , '$mname' , '$lname' , '$email' , '$year' , '$working', '$company', '$position', '$others', '$contact', '$linkedIn', CURRENT_TIMESTAMP )";
          $result = $conn -> query($query);

            if( $result ){
                $successMsg = "Submitted!!";
                setcookie("successMsg", $successMsg, time() + 10, "/");
                header("Location: ./profile.php");
            }else{
                $successMsg = "Error: ". $query ." ". $conn -> error;
            }
        }
        
        }
    }

?>
<!DOCTYPE html>
<html>
<title>College</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="../css/createAlumni.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
  integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
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

  <header style="height: 100px">
    <?php require_once('navbar.php'); ?>
  </header>

  <div class="login">
    <form class="form" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
      <h2>Create Alumni</h2>
      <?php if( $successMsg ){ ?>
      <div class="error-alert">
        <p><?php echo $successMsg ; ?></p>
      </div>
      <?php } ?>

      <table>

        <tr>
          <td>
            <h4>Full Name<span id="star">*</span></h4>
          </td>
          <td><input type="text" name="fname" placeholder="First Name" required>
            <input type="text" name="mname" placeholder="Middle Name" required>
            <input type="text" name="lname" placeholder="Last Name" required></td>
        </tr>

        <tr>
          <td>
            <h4>Email<span id="star">*</span></h4>
          </td>
          <td><input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              placeholder="youremail@email.com" required>
          </td>
        </tr>

        <tr>
          <td>
            <h4>Year of Passing<span id="star">*</span></h4>
          </td>
          <td><select id="year" name="year" required></select></td>
        </tr>

        <tr id="radioBtn">
          <td colspan="2">
            <div class="rb">
              <h4>Working</h4><input type="radio" id="groupA" name="working" value="Yes"
                onchange="myFunction('working')" required>
            </div>
            <div class="rb">
              <h4>Not Working</h4><input type="radio" id="groupB" name="working" onchange="myFunction('not working')"
                value="No" required>
            </div>
          </td>
        </tr>

        <tr id="company">
          <td>
            <h4>Company<span id="star">*</span></h4>
          </td>
          <td><input id="working1" type="text" name="company" placeholder="Company in which you are working"></td>
        </tr>

        <tr id="position">
          <td>
            <h4>Position<span id="star">*</span></h4>
          </td>
          <td><input id="working2" type="text" name="position" placeholder="Your post in that company"></td>
        </tr>

        <tr id="others">
          <td>
            <h4>Mention what you are doing<span id="star">*</span></h4>
          </td>
          <td><input type="text" id="othersRequired" name="others" placeholder="Mention what you are doing here"></td>
        </tr>

        <tr>
          <td>
            <h4>Contact No<span id="star">*</span></h4>
          </td>
          <td><input type="tel" pattern="^\d{10}$" name="contact" required placeholder="only 10 digit allowed"></td>
        </tr>

        <tr>
          <td>
            <h4>LinkedIn Links</h4>
          </td>
          <td><input type="text" name="linkedIn" placeholder="linkedIn">
        </tr>

      </table>

      <a href="/"><i class="fas fa-arrow-left"></i>Go back</a>
      <input type="submit" value="Submit" class="btn" name="submit"><br>
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

  function myFunction(value) {
    if (value == "working") {
      document.getElementById("company").style.display = "table-row";
      document.getElementById("position").style.display = "table-row";
      document.getElementById("others").style.display = "none";
      document.getElementById("working1").setAttribute("required", "");
      document.getElementById("working2").setAttribute("required", "");
      document.getElementById("othersRequired").removeAttribute("required");
    } else {
      document.getElementById("others").style.display = "table-row";
      document.getElementById("company").style.display = "none";
      document.getElementById("position").style.display = "none";
      document.getElementById("othersRequired").setAttribute("required", "");
      document.getElementById("working1").removeAttribute("required");
      document.getElementById("working2").removeAttribute("required");
    }
  }
  </script>

  <script src="../js/main.js"></script>
</body>

</html>