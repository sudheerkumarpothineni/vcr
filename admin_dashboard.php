<?php
session_start();
if(!$_SESSION['email']){
	header("location:index.php");
}
include_once('includes/conn.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard VCR Task</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">VCR</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="agents_list.php">Agents</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['first_name'];?></a></li>
      <li><a href="signout.php"><span class="glyphicon glyphicon-log-in"></span> Sign-out</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <h3>Welcome <?php echo $_SESSION['first_name'];?></h3>
</div>
</body>
</html>