<?php 
	require "dbConn.php";
	
	$query = "SELECT * FROM clgnews";
	$result = $conn -> query($query);
?>
<!DOCTYPE html>
<html>
<title>College</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/clgnews.css">
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

  <header style="
  margin: 0px;
  width: 100%;
  height: 100px;
">
    <?php require_once('navbar.php'); ?>
  </header>

  <div class="container">

    <h3>EVENTS & NEWS</h3>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab1">
        <div class="row">
          <div class="row">

            <?php
									$numRow = $result->num_rows;
									if( $numRow > 0){
										for( $i = 0 ; $i < $numRow ; $i++ ){
											$result->data_seek($i);
											$rows = $result->fetch_array(MYSQLI_ASSOC);
                      
                    $dateElements = explode('/', $rows['date']);
                    switch ($dateElements[1]) {
                      case '01'    :  $mo = "JAN";
                                      break;
                      case '02'    :  $mo = "FEB";
                                      break;
                      case '03'    :  $mo = "MAR";
                                      break;
                      case '04'    :  $mo = "APR";
                                      break;
                      case '05'    :  $mo = "MAY";
                                      break;
                      case '06'    :  $mo = "JUN";
                                      break;
                      case '07'    :  $mo = "JUL";
                                      break;
                      case '08'    :  $mo = "AUG";
                                      break;
                      case '09'    :  $mo = "SEP";
                                      break;
                      case '10'    :  $mo = "OCT";
                                      break;
                      case '11'    :  $mo = "NOV";
                                      break;
                      case '12'    :  $mo = "DEC";
                                      break;
                    } 
								?>
            <div class="media">
              <a class="pull-left" href="#"><span
                  class="dateEl"><em><?php echo $dateElements[0]?></em><?php echo $mo ?></span></a>
              <div class="media-body">
                <h4 class="media-heading">
                  <a href="<?php echo $rows['link'] ?>"><?php echo $rows['title'] ?></a>
                </h4>
                <div class="meta-data">
                  <span class="longDate"><?php echo $rows['date'] ?></span>
                  <!-- <span class="timeEl">12:00pm - 02:00pm</span> -->
                </div>
                <p>
                  <?php echo $rows['description'] ?>
                </p>
              </div><!-- / media-body -->
            </div><!-- / media -->
            <?php }
										}else{ ?>
            <div class="no-data">
              <p>Nothing to show for now.</p>
            </div>
            <?php } ?>

          </div><!-- / .col-md-6 -->

        </div><!-- / row -->
      </div>
    </div>
  </div>

  <script src="../js/main.js"></script>
  <script async type="text/javascript"
    src="//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/2a489a6d42a4b8e667c6d5aa54176aa6b72b4bfa9e8c92b17af5f7b493dd17bc.js">
  </script>
</body>

</html>