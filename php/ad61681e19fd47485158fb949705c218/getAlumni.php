<!DOCTYPE html>
<html>

<head>
  <title>Alumni</title>
  <link rel="shortcut icon" href="../img/chessfree.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">


  <link rel="stylesheet" href="http://vcetalumni.ga/css/profile.css">
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>	<![endif]-->
  <style>
  body {
    background-image: url("../../img/books.png");
    background-size: cover;
  }
  </style>
</head>

<body>
  <h1 style="text-align:center; font-size: 60px;">Alumni</h1>
  <?php if( isset($_COOKIE['successMsg']) ) { ?>
  <p id="regMsg"><?php echo $_COOKIE['successMsg']; ?></p>
  <?php }else if( isset($_COOKIE['addedMsg']) ) { ?>
  <p id="regMsg"><?php echo $_COOKIE['addedMsg']; ?></p>
  <?php } ?>

  <h2 style="text-align:center; font-size: 30px;">Alumni detail</h1>
    <div id="infopart">
      <?php 
    require_once ('../dbConn.php');
      session_start();
      $loginError = "";
    if( isset($_SESSION['adminData']) ){
      $sql = "SELECT * FROM alumni";
        $result = $conn -> query($sql);
      if( $_SESSION['adminData'] == 'Admin Logged go' ){
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
      <?php } } }
										}else{ ?>
      <div class="no-data">
        <p>You are not allowed to see any alumni. Log in first</p>
      </div>
      <?php } ?>
      <br><br>
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