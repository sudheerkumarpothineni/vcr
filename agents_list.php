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
	<title>Agents List</title>
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
      <li class="active"><a href="agents_list.php">Agents</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['first_name'];?></a></li>
      <li><a href="signout.php"><span class="glyphicon glyphicon-log-in"></span> Sign-out</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <a href="agent_create.php"><button type="button" class="btn btn-info">Create</button></a>
  <h3>Agents List</h3>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>password</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $select=$conn->prepare("select * from agents where user_type='".Agent."'");
          $select->execute();
          $result = $select->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $key => $value) { ?>
            <tr>
              <td>1</td>
              <td><?php echo $value['first_name']?></td>
              <td><?php echo $value['last_name']?></td>
              <td><?php echo $value['email']?></td>
              <td><?php echo $value['password']?></td>
              <td><?php echo $value['phone']?></td>
              <td><a href="agent_create.php?origin=<?php echo $value['origin']?>">Edit</a>|<a href="agent_delete.php?origin=<?php echo $value['origin']?>">Delete</a></td>
            </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
</div>
</body>
</html>