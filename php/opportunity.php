<?php 
  // error_reporting(0);
	require "dbConn.php";

	$sql = "SELECT * FROM opportunity";
	
	$opp = $conn -> query($sql);
  $studentQuery = "SELECT id,email FROM students";
	$studentData = $conn -> query($studentQuery);
  $numStud = $studentData->num_rows;
?>
<!DOCTYPE html>
<html>
<title>College</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/style.css">
<!-- <link rel="stylesheet" href="../css/login.css"> -->
<link rel="shortcut icon" href="../img/chessfree.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<style>
body {
  background-image: url("../img/books.png");
  background-size: cover;
}

a {
  text-decoration: none;
}

a:hover {
  text-decoration: none;
}

.container {
  position: relative;
  width: 20%;
  float: left;
  padding: 10px;
}

.image>span {
  margin: 30px;
  position: absolute;
  top: 13%;
  left: 4%;
  font-size: 20px;
}


.image {
  color: white;
  opacity: 1;
  display: block;
  width: 100%;
  height: 140px;
  text-align: center;
  transition: .5s ease;
  backface-visibility: hidden;
  background-color: blue;
  /* For browsers that do not support gradients */
  background-image: linear-gradient(to bottom right, #de6262, #ffb88c);
  /* Standard syntax (must be last) */
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.container:hover .image {
  opacity: 0.3;
}

.container:hover .middle {
  opacity: 1;
}

.text {
  background-color: #4286f4;
  color: white;
  font-size: 14px;
  padding: 8px 16px;
}
</style>

<body id="myPage">

  <!-- Navbar -->

  <header style="
  margin: 0px;
  width: 100%;
  height: 100px;
">
    <?php require_once('navbar.php'); ?>
  </header>

  <section class="" id="">
    <div class="">
      <h2>List of Opportunities </h2>

      <?php if( $opp -> num_rows > 0){
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
      <div class="container">
        <div class="image">
          <b><?php echo $oppData['title'] ?></b>
          <p><?php echo $oppData['description'] ?></p>
          <p><b>Posted By: </b><?php echo $foundEmail ?></p>
        </div>
        <div class="middle">
          <a href="<?php echo $oppData['link'] ?>" target="blank">
            <div class="text">Click for More</div>
          </a>
        </div>
      </div>
      <?php }
	}else{?>
      <div>We don't have any opportunity to show.</div>
      <?php  }?>

    </div>

  </section>


  <script src="../js/main.js"></script>
  <script async type="text/javascript"
    src="//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/2a489a6d42a4b8e667c6d5aa54176aa6b72b4bfa9e8c92b17af5f7b493dd17bc.js">
  </script>
</body>

</html>