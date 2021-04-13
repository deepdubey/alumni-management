<?php 
  // error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    body{
      background-image: url("../../img/books.png");
      background-size: cover;
    }
    </style>
</head>

<body>
  <div>
    <h1 style="text-align:center; font-size: 60px;">List of Students</h1>

    <?php 
    require_once ('../dbConn.php');
  session_start();
	$loginError = "";
 if( isset($_SESSION['adminData']) ){
   $sql = "SELECT * FROM students";
	  $student = $conn -> query($sql);
  if( $_SESSION['adminData'] == 'Admin Logged go' ){
    if( $student -> num_rows > 0){
    while( $studentData = $student -> fetch_assoc() ){ ?>
    <div
      style="width:30%; float: left; margin: 10px auto 0px 10px; border: 2px solid #cc4400;text-align: center; background-color: #ffaa80">
      <h3><b>Email: <b><?php echo $studentData['email'] ?></h3>
      <p><b>SignUp Date: </b><?php echo $studentData['signup_date'] ?></p>

      <div>
        <!-- <a href="editStudent.php?id=<?php //echo $studentData['id'] ?>"><button id="edit">Edit
            Info</button></a> -->
        <form action="studentDelete.php?id=<?php echo $studentData['id'] ?>" method="post">
          <button onclick="return ConfirmDelete();" type="submit" name="delete">Delete</button>
        </form>

      </div>
    </div>
    <?php }
	  }
  }
}else{?>
    <div>You have not allowed log in first to see any student. Log in first</div>
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