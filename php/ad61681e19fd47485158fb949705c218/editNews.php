<?php
	session_start();
  if( !isset($_SESSION['adminData']) ){
    header( "Location: getAllLogin.php" );
  }
	$Msg = '';
	require_once('../dbConn.php');
    $id = $_GET['id'];
    $sql = "SELECT title, date, description, link FROM clgnews WHERE id='$id' ";
	
	$news = $conn -> query($sql);
	$rows = $news -> fetch_assoc();

    if (isset( $_POST['save'] )) {
        function validateFormData( $formData ) {
            $formData = trim($formData);
            $formData = stripslashes($formData);
            $formData = htmlspecialchars($formData);
            return $formData;
        } 
 
        $title = validateFormData($_POST['title']);
        $date = validateFormData($_POST['date']);
        $description = validateFormData($_POST['description']);
        $link = validateFormData($_POST['link']);


		$query = "UPDATE clgnews SET title='$title', date='$date', description='$description', link='$link' WHERE id = '$id' ";
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
  <!-- <link rel="stylesheet" href="../css/createAlumni.css"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
    integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <link href="http://vcetalumni.ga/window-date-picker-master/dist/css/window-date-picker.css" rel="stylesheet">
</head>
<style>
body {
  background-image: url("../../img/books.png");
  background-size: cover;
}
</style>

<body>
  <h1>Edit News</h1>
  <form action="<?php echo htmlspecialchars('editNews.php?id='.$id)?>" method="post" style="width: 60%; margin: auto">
    <fieldset>
      <legend style="padding: 0px 10px 0px 10px;
    text-align: center;"> Create Opportunities </legend>

      <?php if( $Msg ){ ?>
      <div style="background: green; color: white; text-align: center;">
        <p><?php echo $Msg ; ?></p>
      </div>
      <?php } ?>

      <table>
        <tr>
          <td>Title</td>
          <td><input type="text" name="title" id="title" placeholder="Title of Job" maxlength="100"
              value="<?php echo $rows['title']?>" required></td>
        </tr>

        <tr>
          <td>Date</td>
          <td>
            <div id="picker"></div>
            <input id="demo" type="text" name="date" maxlength="30" required class="readonly"
              value="<?php echo $rows['date']?>">
            <button id="toggle">D&T Picker</button>
          </td>
        </tr>

        <tr>
          <td>Description</td>
          <td><textarea name="description" id="description" cols="30" rows="4" maxlength="100"
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
          <td><a href="getNews.php" style="text-decoration: none;border: 1px solid black;"><i
                class="fas fa-arrow-left"></i> Go
              back</a></td>
          <td><input type="submit" name="save" value="Submit"></td>
        </tr>
      </table>
    </fieldset>
  </form>
  <script src="http://vcetalumni.ga/window-date-picker-master/dist/js/window-date-picker.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
  const picker = new WindowDatePicker({
    el: '#picker',
    toggleEl: '#toggle',
    inputEl: '#demo',
    type: 'DATEHOUR'
  });
  $(".readonly").on('keydown paste', function(e) {
    e.preventDefault();
  });
  </script>
</body>


</html>