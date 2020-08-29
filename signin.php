<!DOCTYPE HTML>
<html>
<head>
<title>Login to your account</title>
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
<h1>Sign In</h1>
<p>Login to MyChat</p>
</div>
<div class="form-group">
<label>Email</label>
<input type="email" class="form-control" name="email" placeholder="someone@site.com" autocomplete="off" required></input>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" class="form-control" name="pass" placeholder="Password" autocomplete="off" required></input>
</div>
<div class="form-group">
<div class="small">Forgot password? <a href="forgot_pass.php">Click Here</a></div><br/>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_in">Sign In</button>
</div>
<?php include("signin_user.php"); ?>
<div class="text-center small" style="color:#67428B;">Don't have an account? <a href="signup.php">Create one</a></div>
</div>
</form>
</body>
</html>
