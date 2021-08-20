<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if(!$_SESSION['email']){
	header("location:index.php");
}
include_once('includes/conn.php');
?>

<?php
if (isset($_GET['origin'])) {
  // echo "get";exit;
          $select=$conn->prepare("select * from agents where origin='".$_GET['origin']."'");
          $select->execute();
          $result = $select->fetchAll(PDO::FETCH_ASSOC);
         // echo "<pre>"; print_r($result);exit;
          $origin = $result[0]['origin'];
          $first_name = $result[0]['first_name'];
          $last_name = $result[0]['last_name'];
          $email = $result[0]['email'];
          $password = $result[0]['password'];
          $phone = $result[0]['phone'];

}



if (isset($_POST['agent_add'])) {
  // echo "string";exit;
  $origin = $_POST['origin'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $user_type = Agent;
  $phone = $_POST['phone'];
  if ($origin) {
    $query = $conn->prepare("UPDATE agents SET first_name='$first_name',last_name='$last_name',email='$email',password='$password',phone='$phone' WHERE origin='$origin'");
  }
  else{
    $query = $conn->prepare("INSERT INTO agents(first_name,last_name,email,password,user_type,phone)VALUES(:first_name, :last_name, :email, :password, :user_type, :phone)");
  }
  $query->bindParam(':first_name', $first_name);
  $query->bindParam(':last_name', $last_name);
  $query->bindParam(':email', $email);
  $query->bindParam(':password', $password);
  $query->bindParam(':user_type', $user_type);
  $query->bindParam(':phone', $phone);
  
  $final=$query->execute();
  header("location:agents_list.php");
}


?>
<!DOCTYPE html>
<html>
<head>
  <?php
            if (isset($_GET['origin'])) {
              $title='Update';
            }
            else{
              $title='Create';
            }
            ?>
	<title>Agents <?php echo $title?></title>
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
  <form name="agent" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
          <div class="form-group col-sm-4">
            <label>Firstname</label>
            <input type="text" name="first_name" placeholder="Firstname" required class="form-control form-validation" value="<?php echo $first_name?>">
            <input type="hidden" name="origin" value="<?php echo $origin?>">
          </div>
          <div class="form-group col-sm-4">
            <label>Lastname</label>
            <input type="text" name="last_name" placeholder="Lastname" required class="form-control form-validation"value="<?php echo $last_name?>">
          </div>
          <div class="form-group col-sm-4">
            <label>Phone</label>
            <input type="text" name="phone" placeholder="Phone" required class="form-control form-validation" value="<?php echo $phone?>">
          </div>
          <div class="form-group col-sm-4">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required class="form-control form-validation" value="<?php echo $email?>">
          </div>
          <div class="form-group col-sm-4">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required class="form-control form-validation" value="<?php echo $password?>">
          </div>
          <div class="form-group col-sm-4">
            <label></label>
            <?php
            if (isset($_GET['origin'])) {
              $value='update';
            }
            else{
              $value='insert';
            }
            ?>
            <input type="submit" name="agent_add" value="<?php echo $value?>" class="form-control btn btn-info">            
          </div>
        </form>
</div>
</body>
</html>