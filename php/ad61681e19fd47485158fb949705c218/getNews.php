<?php
	session_start();
	require "../dbConn.php";
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
  <link rel="stylesheet" type="text/css" href="http://vcetalumni.ga/css/clgnews.css">

  <div class="container">

    <h1 style="text-align:center; font-size: 60px;">EVENTS & NEWS</h1>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab1">
        <div class="row">
          <div class="row">

            <?php 
            if( isset($_SESSION['adminData']) ){
              $query = "SELECT * FROM clgnews";
              $result = $conn -> query($query);
              if( $_SESSION['adminData'] == 'Admin Logged go' ){
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

                <form action="newsDelete.php?id=<?php echo $rows['id'] ?>" method="post">
                  <button onclick="return ConfirmDelete();" type="submit" name="delete">Delete</button>
                </form>

                <a href="editNews.php?id=<?php echo $rows['id'] ?>"><button id="edit">Edit Info</button></a>
              </div><!-- / media-body -->
            </div><!-- / media -->
            <?php }
                }
              }
            }else{?>
            <div>You have not allowed log in first to see any News. Log in first</div>
            <?php  }?>

          </div><!-- / .col-md-6 -->

        </div><!-- / row -->
      </div>
    </div>
  </div>

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