<?php 
  // error_reporting(0);
  require_once ('../dbConn.php');
  session_start();
  $studentQuery = "SELECT id,email FROM students";
	$studentData = $conn -> query($studentQuery);
  $numStud = $studentData->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
  body {
    background-image: url("../../img/books.png");
    background-size: cover;
  }
  </style>
</head>

<body>
  <div>
    <h1 style="text-align:center; font-size: 60px;">List of Oportunities</h1>

    <?php 
	$loginError = "";
 if( isset($_SESSION['adminData']) ){
   $sql = "SELECT * FROM opportunity";
	  $opp = $conn -> query($sql);
  if( $_SESSION['adminData'] == 'Admin Logged go' ){
    if( $opp -> num_rows > 0){
    while( $oppData = $opp -> fetch_assoc() ){ 
      for( $i = 0 ; $i < $numStud ; $i++ ){
        $studentData->data_seek($i);
        $student = $studentData->fetch_array(MYSQLI_ASSOC);
        if( $oppData['studentId'] == $student['id'] ){
          $foundEmail = $student['email'];
          break;
        }
      }
    ?>
    <div
      style="width:30%; float: left; margin: 10px auto 0px 10px; border: 2px solid blue;text-align: center; background-color: #e0ebeb">
      <h3><b>Title: </b><?php echo $oppData['title'] ?></h3>
      <p><b>Description: </b><?php echo $oppData['description'] ?></p>
      <p><b>Posted By: </b><?php echo $foundEmail ?></p>
      <a style="width:80px;text-decoration: none;word-break: break-all;" href="<?php echo $oppData['link'] ?>"><b>More
          visit link: </b><?php echo $oppData['link'] ?></a>

      <div>
        <br>
        <a href="editOpportunity.php?id=<?php echo $oppData['id'] ?>"><button id="edit">Edit
            Info</button><br><br></a>
        <form action="opportunityDelete.php?id=<?php echo $oppData['id'] ?>" method="post">
          <button onclick="return ConfirmDelete();" type="submit" name="delete">Delete</button>
        </form>

      </div>
    </div>
    <?php }
	  }
  }
}else{?>
    <div>You have not allowed log in first to see any opportunity. Log in first</div>
    <?php  }?>
  </div>

  <script>
  function ConfirmDelete() {
    var x = confirm("Are you sure you want to delete?");
    if (x)
      return true;
    else
      return false;
  }
  </script>

</body>

</html>