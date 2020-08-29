<!DOCTYPE HTML>
<?php
session_start();
include("include/connection.php");
include("include/header.php");
if(!isset($_SESSION['user_email']))
	header("location: signin.php");
else{
?>
<html>
<head>
<title>Change password</title>
<meta charset="utf-8">
<meta name="viewport" content="width=devide-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<style>
body{
	overflow-x:hidden;
	background-image:url('gifs/gif2.gif');
	background-repeat:no-repeat;
	background-size:cover;
}

tr{
	border:2px solid black;
}
</style>
</head>
<body>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<form action="" method="post" enctype="multipart/form-data">
			<table class="table table-bordered table-hover" style="border:5px solid black; box-shadow: inset 0 20px 50px tomato, 0 20px 50px black; background-color:white;">
					
				<tr align="center">
					<td colspan="6" class="active" style="background-color:lightgreen;"><h1><i>Change Password</i></h1></td>
				</tr>
				
				<tr>
					<td style="font-weight:bold; vertical-align:middle;" colspan="3">Current password</td>
					<td colspan="3">
						<input type="password" name="c_pass" id="mypass" class="form-control" required placeholder="Current password">
					</td>
				</tr>
				
				<tr>
					<td style="font-weight:bold; vertical-align:middle;" colspan="3">New password</td>
					<td colspan="3">
						<input type="password" name="u_pass1" id="mypass" class="form-control" required placeholder="New password">
					</td>
				</tr>
				
				<tr>
					<td style="font-weight:bold; vertical-align:middle;" colspan="3">Confirm password</td>
					<td colspan="3">
						<input type="password" name="u_pass2" id="mypass" class="form-control" required placeholder="Confirm password">
					</td>
				</tr>
				
				<tr align="center">
					<td colspan="6">
						<input type="submit" name="change" value="Change" class="btn btn-info btn-block btn-lg">
					</td>
				</tr>
			</table>
		</form>
		
		<?php
			if(isset($_POST['change'])){
				
				$c_pass=$_POST['c_pass'];
				$pass1=$_POST['u_pass1'];
				$pass2=$_POST['u_pass2'];
				
				$user=$_SESSION['user_email'];
				$get_user="select * from users where user_email='$user'";
				$run_user=mysqli_query($con,$get_user);
				$row=mysqli_fetch_array($run_user);
				
				$user_password=$row['user_pass'];
				if($c_pass!=$user_password){
					echo "
						<div class='alert alert-danger'>
							<center><strong>Your old password didn't match.</strong></center>
						</div>
					";
				}
				
				if($pass1!=$pass2){
					echo "
						<div class='alert alert-danger'>
							<center><strong>Your new password didn't match with confirm password.</strong></center>
						</div>
					";
				}
				
				if(strlen($pass1)<8 AND strlen($pass2)<8){
					echo "
						<div class='alert alert-danger'>
							<center><strong>Use 9 or more than 9 characters.</strong></center>
						</div>
					";
				}
				
				if($pass1==$pass2 AND strlen($pass1)>=8 AND strlen($pass2)>=8 AND $c_pass==$user_password){
					$update_pass=mysqli_query($con,"update users set user_pass='$pass1' where user_email='$user'");
					echo "
						<div class='alert alert-danger'>
							<center><strong>Your password is changed.</strong></center>
						</div>
					";
				}
				
			}
		?>
		
	</div>
	<div class="col-sm-2">
	</div>
</div>
</body>
</html>
<?php } ?>
