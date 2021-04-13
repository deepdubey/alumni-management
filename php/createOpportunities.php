<?php
    // error_reporting(0);
    session_start();
    if( !$_SESSION['loggedInId'] ){
        header( "Location: login.php" );
    }
     $title = $description = $link = $addedMsg = "";
    require_once('dbConn.php');

    if (isset( $_POST['submit'] )) {
        function validateFormData( $formData ) {
            $formData = trim($formData);
            $formData = stripslashes($formData);
            $formData = htmlspecialchars($formData);
            return $formData;
        }
        
        $bytes = random_bytes(16);
        $id = bin2hex($bytes);

        $studentId = $_SESSION['loggedInId'];
        
        $title = validateFormData($_POST['title']);
        $description = validateFormData($_POST['description']);
        $link = validateFormData($_POST['link']);
        
        if( $title && $description && $link )
        {
          $query = "INSERT INTO opportunity(id, title, description, link, postDate, studentId) 
          VALUES( '$id', '$title' , '$description' , '$link', CURRENT_TIMESTAMP,  '$studentId')";
          $result = $conn -> query($query);

            if( $result ){
                $addedMsg = "Added one opportunity!!";
                setcookie("addedMsg", $addedMsg, time() + 10, "/");
                header("Location: ./profile.php");
            }else{
                echo ("Error: ". $query ." ". $conn -> error);
            }
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
  integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
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

  <header style="height: 100px">
    <?php require_once('navbar.php'); ?>
  </header>
  <h1>Create Opportunity:</h1>
  <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" style="width: 60%; margin: auto">
    <fieldset>
      <legend style="padding: 0px 10px 0px 10px;
    text-align: center;"> Create Opportunities </legend>

      <?php if( $addedMsg ){ ?>
      <div class="error-alert">
        <p><?php echo $addedMsg ; ?></p>
      </div>
      <?php } ?>

      <table>
        <tr>
          <td>Title</td>
          <td><input type="text" name="title" id="title" placeholder="Title of Job" maxlength="150" required></td>
        </tr>
        <tr>
          <td>Description</td>
          <td><textarea name="description" id="description" cols="30" rows="4" maxlength="200"
              placeholder="Give specific details, maximum 200 character" required></textarea></td>
        </tr>

        <tr>
          <td>Link of job</td>
          <td><input type="url" name="link" id="link" placeholder="Link is helpful to get details"></td>
        </tr>

        <tr>
          <td><br></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" value="Submit"></td>
        </tr>
      </table>
    </fieldset>
  </form>

  <script src="../js/main.js"></script>
</body>

</html>