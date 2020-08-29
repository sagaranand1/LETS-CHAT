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
<title>Account Settings</title>
<meta charset="utf-8">
<meta name="viewport" content="width=devide-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<style>
body{
	background-image:url('gifs/gif1.gif');
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
		<?php
			$user=$_SESSION['user_email'];
			$get_user="select * from users where user_email='$user'";
			$run_user=mysqli_query($con,$get_user);
			$row=mysqli_fetch_array($run_user);
			
			$user_id=$row['user_id'];
			$user_name=$row['user_name'];
			$user_pass=$row['user_pass'];
			$user_email=$row['user_email'];
			$user_profile=$row['user_profile'];
			$user_country=$row['user_country'];
			$user_gender=$row['user_gender'];
		?>
		
		<div class="col-sm-8">
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table table-bordered table-hover" style="border:6px solid black; box-shadow: inset 0 20px 50px tomato, 0 20px 50px black; background-color:white;">
					
					<tr align="center" style="background-color:pink; border-bottom:5px solid red;">
						<td colspan="6" class="active"><h1><i>Change Account Settings</i></h1></td>
					</tr>
					
					<tr>
						<td style="font-weight:bold; vertical-align:middle;" colspan="3">Change your Username</td>
						<td colspan="3">
							<input type="text" name="u_name" class="form-control" required value="<?php echo $user_name; ?>">
						</td>
					</tr>
					
					<tr>
						<td colspan="3" style="font-weight:bold; vertical-align:middle;">Change your profile pic</td>
						<td colspan="3">
							<a class="btn btn-default" style="text-decoration:none; font-size:15px;" href="upload.php"><i class="fa fa-user" aria-hidden="true"></i>Change Profile
						</td>
					</tr>
					
					<tr>
						<td colspan="3" style="font-weight:bold; vertical-align:middle;">Change your Email</td>
						<td colspan="3">
							<input type="email" name="u_email" class="form-control" required value="<?php echo $user_email; ?>">
						</td>
					</tr>
					
					<tr>
						<td colspan="3" style="font-weight:bold; vertical-align:middle;">Country</td>
						<td colspan="3">
							<select class="form-control" name="u_country">
								<option><?php echo $user_country; ?></option>
								<option>USA</option>
								<option>UK</option>
								<option>UAE</option>
								<option>Saudi Arabia</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td colspan="3" style="font-weight:bold; vertical-align:middle;">Gender</td>
						<td colspan="3">
							<select class="form-control" name="u_gender">
								<option><?php echo $user_gender; ?></option>
								<option>Male</option>
								<option>Female</option>
								<option>Other</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td colspan="3" style="font-weight:bold; vertical-align:middle;">Forgotten Password</td>
						<td colspan="3">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Forgotten Password</button>
							<div id="myModal" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>											
										</div>
										
										<div class="modal-body">
											<form action="recovery.php?id=<?php echo $user_id; ?>" method="post" id="f">
												<strong>What is your school's best friend name?</strong><br><br>
												<textarea class="form-control" cols="83" rows="4" name="content" placeholder="Someone"></textarea><br>
												<center><input type="submit" class="btn btn-default" name="sub" value="Submit" style="width:100px;"><br><br>
												<pre style="font-weight:bold; font-size:15px;">Answer the above question.. <br>We will ask you this if you forget your password.</pre></center><br><br>
											</form>
											<?php 
												if(isset($_POST['sub']))
												{
													$bfn=htmlentities($_POST['content']);
													if($bfn==''){
														echo "<script>alert('Please enter something.');</script>";
														echo "<script>window.open('account_settings.php','_self');</script>";
													}
													else{
														$update="update users set forgotten_answer='$bfn' where user_email='$user'";
														$run=mysqli_query($con,$update);
														if($run){
															echo "<script>alert('Working...');</script>";
															echo "<script>window.open('account_settings.php','_self')</script>";
														}
														else{
															echo "<script>alert('Error while updating information.');</script>";
															echo "<script>window.open('account_settings.php','_self')</script>";
														}
													}
												}
											?>
										</div>
										
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>									
										</div>
										
									</div>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="font-weight:bold; vertical-align:middle;">Change password</td>
						<td colspan="3"><a class="btn btn-default" style="text-decoration:none; font-size:15px;" href="change_password.php"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Change password</td>
					</tr>
					
					<tr align="center">
						<td colspan="6">
							<input type="submit" value="Update" name="update" class="btn btn-info btn-block btn-lg">
						</td>
					</tr>
					
				</table>
			</form>
			<?php
				if(isset($_POST['update']))
				{
					$user_name=htmlentities($_POST['u_name']);
					$email=htmlentities($_POST['u_email']);
					$u_country=htmlentities($_POST['u_country']);
					$u_gender=htmlentities($_POST['u_gender']);
					$update="update users set user_name='$user_name', user_email='$email', user_country='$u_country', user_gender='$u_gender' where user_email='$user'";
					$run=mysqli_query($con,$update);
					if($run){
						echo "<script>alert('Details updated successfully');</script>";
						echo "<script>window.open('account_settings.php','_self');</script>";
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
