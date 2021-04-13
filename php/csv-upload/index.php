<?php
// Load the database configuration file
include_once '../dbConn.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
  <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<!-- Bootstrap library -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Stylesheet file -->
<!-- <link rel="stylesheet" href="assets/css/style.css"> -->

<style>
.row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: 15px;
  margin-left: 15px;
}
</style>
<h1>Upload CSV Here:</h1>
<div class="row">

  <!-- Import link -->
  <div class="col-md-12 head">
    <div class="float-right">
      <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i>
        Import</a>
    </div>
  </div>
  <!-- CSV file upload form -->
  <div class="col-md-12" id="importFrm" style="display: none;">
    <form action="importData.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file" />
      <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
    </form>
  </div>

  <!-- Data list table -->
  <table class="table table-striped table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>#ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Year of Passing</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Get member rows
        $result = $conn->query("SELECT * FROM added_alumni ORDER BY id DESC");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['yop']; ?></td>
      </tr>
      <?php } }else{ ?>
      <tr>
        <td colspan="5">No member(s) found...</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID) {
  var element = document.getElementById(ID);
  if (element.style.display === "none") {
    element.style.display = "block";
  } else {
    element.style.display = "none";
  }
}
</script>