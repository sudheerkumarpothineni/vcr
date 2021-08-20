<?php
error_reporting(E_ALL & ~E_NOTICE);
include_once('includes/conn.php');
if (isset($_POST['signin'])) {
	$email=$_POST['email'];
    $password=$_POST['password'];
    $select=$conn->prepare("select * from agents where email='$email' and password='$password'");
    $select->execute();
    $result = $select->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";print_r($result);
    if ($result!=null) {
    	session_start();
    	if ($result[0]['user_type'] == Admin) {
    		// echo "admin";
    		$_SESSION['email'] = $result[0]['email'];
			$_SESSION['password'] = $result[0]['password'];
			$_SESSION['first_name'] = $result[0]['first_name'];
			header("location:admin_dashboard.php");

    	}
    	else{
    		// echo "agent";
    		$_SESSION['email'] = $result[0]['email'];
			$_SESSION['password'] = $result[0]['password'];
			$_SESSION['first_name'] = $result[0]['first_name'];
			header("location:agent_dashboard.php");
    	}
    }
    else{
    	echo "<br>"."<span style='text-center'>user not exists</span>";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>VCR Signin main section checking</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="includes/style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4" id="signin_div">
				<h3 class="text-center">VCR</h3>
				<h4 class="text-center">Signin to proceed</h4>
				<form name="sign-in" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" placeholder="Email" required class="form-control form-validation">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" placeholder="Password" required class="form-control form-validation">
					</div>
					<div class="form-group">
						<label></label>
						<input type="submit" name="signin"value="signin" class="form-control btn btn-info" id="sign-in">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>