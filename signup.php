<!DOCTYPE HTML>
<html>
<head>
<title>Create new account</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>
<div class="signup-form">
<form action="" method="post">
<div class="form-header">
<h1>Sign Up</h1>
<p>Fill out this form and start chatting with your friends.</p>
</div>
<div class="form-group">
<label>Username</label>
<input type="text" class="form-control" name="user_name" placeholder="Example: alisher" autocomplete="off" required></input>
</div>
<div class="form-group">
<label>Email Address</label>
<input type="email" class="form-control" name="user_email" placeholder="someone@site.com" autocomplete="off" required></input>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" class="form-control" name="pass" placeholder="user_pass" autocomplete="off" required></input>
</div>
<div class="form-group">
<label>Country</label>
<select class="form-control" name="user_country" required>
<option disabled="">Select a country</option>
<option>India</option>
<option>USA</option>
<option>Pakistan</option>
<option>UK</option>
<option>Bangladesh</option>
<option>France</option>
</select>
</div>
<div class="form-group">
<label>Gender</label>
<select class="form-control" name="user_gender" required>
<option disabled="">Select your gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>
</div>
<div class="form-group">
<label class="checkbox-inline"><input type="checkbox" required>I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_up">Sign Up</button>
</div>
<div class="text-center small" style="color:#67428B;">Already have an account? <a href="signin.php">Signin here</a></div>
</div>
</form>
<?php include("signup_user.php"); ?>
</body>
</html>
