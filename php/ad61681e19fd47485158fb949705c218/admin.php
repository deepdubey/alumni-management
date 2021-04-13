<?php
	session_start();
  if( !isset($_SESSION['adminData']) ){
    header( "Location: getAllLogin.php" );
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<style>
body {
  background-image: url("../../img/books.png");
  background-size: cover;
}

a {
  text-decoration: none;
  color: white;
  font-size: 20px;
}

.container {
  margin-left: 35%;
}

h1 {
  font-size: 60px;
}

.btn {
  border: 1px solid black;
  padding: 10px;
  background: #130793;
  text-align: center;
  margin: 30px;
  margin-left: 10%;
  width: 20%;
}
</style>

<body>
  <div class="container">
    <h1>Admin Dashboard</h1>
    <div class="btn"><a href="getOpportunities.php">Opportunities</a></div>
    <div class="btn"><a href="getAlumni.php">Alumni</a></div>
    <div class="btn"><a href="getNews.php">Clg News</a></div>
    <div class="btn"><a href="getStudents.php">All signed Students</a></div>
    <div class="btn"><a href="newsCreate.php">Create News</a></div>
    <div class="btn"><a href="http://vcetalumni.ga/php/csv-upload/">CSV Upload</a></div>
  </div>
</body>

</html>