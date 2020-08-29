<!DOCTYPE HTML>
<html>
<head>
<title>Forgot Password</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/signin.css">
</head>
<body>
<div class="signin-form">
<form action="" method="post">
<div class="form-header">
<h1>Forgot Password</h1>
<p>MyChat</p>
</div>
<div class="form-group">
<label>Email</label>
<input type="email" class="form-control" name="email" placeholder="someone@site.com" autocomplete="off" required></input>
</div>
<div class="form-group">
<label>Bestfriend name</label>
<input type="text" class="form-control" name="bf" placeholder="Someone.." autocomplete="off" required></input>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block btn-lg" name="submit">Submit</button>
</div>
<div class="text-center small" style="color:#67428B;">Back to Signin? <a href="signin.php">Click Here</a></div>
</div>
</form>
<?php
session_start();
include("include/connection.php");
if(isset($_POST['submit'])){
	$email=htmlentities(mysqli_real_escape_string($con,$_POST['email']));
	$recovery_account=htmlentities(mysqli_real_escape_string($con,$_POST['bf']));
	
	$select_user="select * from users where user_email='$email' AND forgotten_answer='$recovery_account'";
	$query=mysqli_query($con,$select_user);
	$check_user=mysqli_num_rows($query);
	
	if($check_user==1){
		$_SESSION['user_email']=$email;
		echo "<script>window.open('create_password.php','_self')</script>";
	}
	else{
		echo "<script>alert('Your email or bestfriend name is incorrect.')</script>";
		echo "<script>window.open('forgot_pass.php','_self')</script>";
	}
	
}
?>
</body>
</html>
