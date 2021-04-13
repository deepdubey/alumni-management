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
<link rel="stylesheet" href="http://vcetalumni.ga/css/profile.css?v=2">
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

  <header style="
  margin: 0px;
  width: 100%;
  height: 100px;
">
    <?php require_once('navbar.php'); ?>
  </header>
  <h1 style="text-align:center">Alumni</h1>

  <h1 style="margin-left: 30%">Our Alumni detail:</h1>
  <div id="infopart">
    <?php 
    require_once ('dbConn.php');
      $sql = "SELECT * FROM alumni";
        $result = $conn -> query($sql);
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

      <br><br>

    </div>
    <?php } 
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

  <script src="../js/main.js"></script>
  <script async type="text/javascript"
    src="//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/2a489a6d42a4b8e667c6d5aa54176aa6b72b4bfa9e8c92b17af5f7b493dd17bc.js">
  </script>
</body>

</html>