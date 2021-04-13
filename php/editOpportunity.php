<?php
	session_start();
	if( !$_SESSION['loggedInEmail'] ){
        header( "Location: login.php" );
    }
	$Msg = '';
	require_once('dbConn.php');
    $id = $_GET['id'];
    $sql = "SELECT title, description, link FROM opportunity WHERE id='$id' ";
	
	$oppData = $conn -> query($sql);
    if(!$oppData) die($conn -> error);
	$rows = $oppData -> fetch_assoc();
    

  if (isset( $_POST['save'] )) {
    function validateFormData( $formData ) {
        $formData = trim($formData);
        $formData = stripslashes($formData);
        $formData = htmlspecialchars($formData);
        return $formData;
    } 

    $title = validateFormData($_POST['title']);
    $description = validateFormData($_POST['description']);
    $link = validateFormData($_POST['link']);

		$query = "UPDATE opportunity SET title='$title', description='$description', link='$link' WHERE id = '$id' ";
		$result = $conn -> query($query);
        if( $result ){
			$Msg = "Changes saved!";
			// header( "Location: ./profile.php" );
        }else{
            $Msg = "Error: ". $query ." ". $conn -> error;
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
  <h1>Edit Opportunity:</h1>
  <form action="<?php echo htmlspecialchars('editOpportunity.php?id='.$id)?>" method="post"
    style="width: 60%; margin: auto">
    <fieldset>
      <legend style="padding: 0px 10px 0px 10px;
    text-align: center;"> Create Opportunities </legend>

      <?php if( $Msg ){ ?>
      <div class="success-alert">
        <p><?php echo $Msg ; ?></p>
      </div>
      <?php } ?>

      <table>
        <tr>
          <td>Title</td>
          <td><input type="text" name="title" id="title" placeholder="Title of Job" maxlength="150"
              value="<?php echo $rows['title']?>" required></td>
        </tr>
        <tr>
          <td>Description</td>
          <td><textarea name="description" id="description" cols="30" rows="4" maxlength="200"
              placeholder="Give specific details, maximum 200 character"
              required><?php echo $rows['description']?></textarea></td>
        </tr>

        <tr>
          <td>Link of job</td>
          <td><input type="url" name="link" id="link" placeholder="Link is helpful to get details"
              value="<?php echo $rows['link']?>"></td>
        </tr>

        <tr>
          <td><br></td>
        </tr>
        <tr>
          <td><a style="border: 1px solid black" href="./profile.php"><i class="fas fa-arrow-left"></i>Go back</a></td>
          <td><input type="submit" name="save" value="Save"></td>
        </tr>
      </table>
    </fieldset>
  </form>

  <script src="../js/main.js"></script>
</body>

</html>