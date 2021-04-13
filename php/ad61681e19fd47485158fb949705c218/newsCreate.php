<?php
	session_start();
  if( !isset($_SESSION['adminData']) ){
    header( "Location: getAllLogin.php" );
  }
     $title = $description = $link = $successMsg = "";
    require_once('../dbConn.php');

    if (isset( $_POST['submit'] )) {
        function validateFormData( $formData ) {
            $formData = trim($formData);
            $formData = stripslashes($formData);
            $formData = htmlspecialchars($formData);
            return $formData;
        }
        
        $bytes = random_bytes(16);
        $id = bin2hex($bytes);
        
        $title = validateFormData($_POST['title']);
        $date = validateFormData($_POST['date']);
        $description = validateFormData($_POST['description']);
        $link = validateFormData($_POST['link']);
        
        if( $title && $description && $link )
        {
          $query = "INSERT INTO clgnews(id, title, date, description, link) 
          VALUES( '$id', '$title' , '$date' , '$description' , '$link')";
          $result = $conn -> query($query);

            if( $result ){
                $addedMsg = "Added one news/event!!";
                setcookie("addedMsg", $addedMsg, time() + 10, "/");
                header("Location: admin.php");
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

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css"> -->
  <link href="http://vcetalumni.ga/window-date-picker-master/dist/css/window-date-picker.css" rel="stylesheet">
  <style>
  body {
    background-image: url("../../img/books.png");
    background-size: cover;
  }
  </style>
</head>

<body>
  <h1 style="text-align:center; font-size: 60px;">Create News and Events</h1>
  <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" style="width: 60%; margin: auto">
    <fieldset>
      <legend style="padding: 0px 10px 0px 10px;
    text-align: center;"> Create News and Events</legend>

      <table>
        <tr>
          <td>Title</td>
          <td><input type="text" name="title" id="title" placeholder="Title of News/Event" maxlength="100" required>
          </td>
        </tr>

        <tr>
          <td>Date</td>
          <td>
            <div id="picker"></div>
            <input id="demo" type="text" name="date" maxlength="30" required class="readonly"
              placeholder="Use D&T picker">
            <button id="toggle">D&T Picker</button>
          </td>
        </tr>

        <tr>
          <td>Description</td>
          <td><textarea name="description" id="description" cols="30" rows="4" maxlength="100"
              placeholder="Give specific details, maximum 100 character" required></textarea></td>
        </tr>

        <tr>
          <td>Link of Event/News</td>
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