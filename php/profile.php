<?php 
  // error_reporting(0);
	session_start();
	if( !$_SESSION['loggedInId'] ){
        header( "Location: login.php" );
	}
	require "dbConn.php";
	
	$query = "SELECT * FROM alumni WHERE id='$_SESSION[loggedInId]'";
	$result = $conn -> query($query);
	$data = $result;
	if(!$result) die($conn -> error);

	$sql = "SELECT * FROM opportunity WHERE studentId='$_SESSION[loggedInId]'";
	
	$opp = $conn -> query($sql);
	// require('statusBar.php');
	// require_once('padding.php');
?>

<!DOCTYPE html>
<html>
<title>College</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="../img/chessfree.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="stylesheet" href="../css/profile.css?v=3">
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>	<![endif]-->
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

  <h1 style="text-align:center">Profile</h1>
  <?php if( isset($_COOKIE['successMsg']) ) { ?>
  <p id="regMsg"><?php echo $_COOKIE['successMsg']; ?></p>
  <?php }else if( isset($_COOKIE['addedMsg']) ) { ?>
  <p id="regMsg"><?php echo $_COOKIE['addedMsg']; ?></p>
  <?php } ?>

  <h1>Your Alumni detail</h1>
  <a href="createAlumni.php"><button id="edit" style="margin-top: -50px">Create Alumni</button></a>
  <div id="infopart">
    <?php
									$numRow = $result->num_rows;
									if( $numRow > 0){
										for( $i = 0 ; $i < $numRow ; $i++ ){
											$result->data_seek($i);
											$rows = $result->fetch_array(MYSQLI_ASSOC); 
								?>
    <div id="tables">
      <br>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th>Name</th>
            <td><?php echo $rows['fname']. ' ' . $rows['mname']. ' ' . $rows['lname'] ?></td>
          </tr>

          <tr>
            <th>Email</th>
            <td><?php echo $rows['email'] ?></td>
          </tr>

          <tr>
            <th>Year of passing college</th>
            <td><?php echo $rows['year'] ?></td>
          </tr>


          <tr>
            <th>Working</th>
            <td><?php echo $rows['working'] ?></td>
          </tr>

          <tr>
            <th>Company</th>
            <td><?php echo $rows['company'] ?></td>
          </tr>

          <tr>
            <th>Position</th>
            <td><?php echo $rows['position'] ?></td>
          </tr>

          <tr>
            <th>Contact</th>
            <td><?php echo $rows['contact'] ?></td>
          </tr>

          <tr>
            <th>LinkedIn Link</th>
            <td><?php echo $rows['linkedIn'] ?></td>
          </tr>

          <tr>
            <th>Created On</th>
            <td><?php echo $rows['createdOn'] ?></td>
          </tr>

        </tbody>
      </table>
      <div>
        <form action="alumniDelete.php?id=<?php echo $rows['id'] ?>" method="post">
          <button onclick="return ConfirmDelete();" type="submit" name="delete">Delete</button>
        </form>

        <a href="editAlumni.php?id=<?php echo $rows['id'] ?>"><button id="edit">Edit Info</button></a>
      </div>

      <br><br>

    </div>
    <?php }
										}else{ ?>
    <div class="no-data">
      <p>You have not created yourself as alumni</p>
    </div>
    <?php } ?>
    <br><br>
  </div>

  <div>
    <h1>Oportunities You Created</h1>
    <a href="createOpportunities.php"><button id="edit" style="margin-top: -50px">Create Opportunity</button></a>

    <?php if( $opp -> num_rows > 0){
		while( $oppData = $opp -> fetch_assoc() ){ ?>
    <div
      style="width:30%; float: left; padding: 5px; text-align: center; margin: 10px auto 0px 10px; border: 2px solid blue;">
      <h2><?php echo $oppData['title'] ?></h2>
      <p><?php echo $oppData['description'] ?></p>
      <a style="width:80px" href="<?php echo $oppData['link'] ?>"><?php echo $oppData['link'] ?></a>
      <div>
        <form action="opportunityDelete.php?id=<?php echo $oppData['id'] ?>" method="post">
          <button onclick="return ConfirmDelete();" type="submit" name="delete">Delete</button>
        </form>

        <a href="editOpportunity.php?id=<?php echo $oppData['id'] ?>"><button id="edit">Edit Info</button></a>
      </div>
    </div>
    <?php }
	}else{?>
    <div class="no-data">
      <h3>You have not created any opportunity.</h3>
    </div>
    <?php  }?>

  </div>
  <script>
  setTimeout(() => {
    document.getElementById("regMsg").style.display = "none";
  }, 3000);

  function ConfirmDelete() {
    var x = confirm("Are you sure you want to delete?");
    if (x)
      return true;
    else
      return false;
  }
  </script>

  <script src="../js/main.js"></script>
</body>

</html>