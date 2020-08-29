<!DOCTYPE HTML>
<html>
<head>
<title>MyChat-HOME</title>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/homepage1.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
include("include/connection.php");
if(!isset($_SESSION['user_email']))
	header("location: signin.php");
else{
?>
<div class="container main-section">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-12 left-slidebar">
			<div class="input-group searchbox">
				<div class="input-group-btn">
					<center><a href="find_friends.php"><button class="btn btn-default search icon alert-danger btn-primary btn-info anu" name="search_user" type="submit">Add new user</button></a></center>
				</div>
			</div>
			<div class="left-chat">
				<ul>
					<?php include("get_users_data.php"); ?>
				</ul>
			</div>
		</div>
		<div class="col-md-9 col-sm-9 col-xs-12 right-slidebar">
			<div class="row">
				<?php 
					$user=$_SESSION['user_email'];
					$get_user="select * from users where user_email='$user'";
					$run_user=mysqli_query($con,$get_user);
					$row=mysqli_fetch_array($run_user);
					$user_id=$row['user_id'];
					$user_name=$row['user_name'];
				?>
			
				<?php
					if(isset($_GET['user_name']))
					{
						global $con;
						$get_username=$_GET['user_name'];
						$get_user="select * from users where user_name='$get_username'";
						$run_user=mysqli_query($con,$get_user);
						$row=mysqli_fetch_array($run_user);
						$username=$row['user_name'];
						$user_profile_image=$row['user_profile'];
					}
					$total_messages="select * from users_chat where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
					$run_messages=mysqli_query($con,$total_messages);
					$total=mysqli_num_rows($run_messages);
				?>
				<div class="col-md-12 right-header">
					<div class="right-header-img">
						<img src=<?php echo "$user_profile_image";?>>
					</div>
					<div class="right-header-detail">
						<form method="post">
							<p><?php echo "$username"; ?></p>
							<span><?php echo $total; ?> messages</span>&nbsp &nbsp
							<button name="logout" class="btn btn-danger cllo">Logout</button>
						</form>
						<?php 
						if(isset($_POST['logout']))
						{
							$update_msg=mysqli_query($con,"update users set log_in='Offline' where user_name='$user_name'");
							header("Location:logout.php");
							exit();
						}
						?>
					</div>
				</div>
			</div>
			<?php	if(isset($_POST['submit']))
	{
		$msg=htmlentities($_POST['msg_content']);
		if($msg=="")
		{ }
		else if(strlen($msg)>100)
		{
			echo "<script>alert('Message is too long. Use only 100 characters.');</script>";
		}
		else
		{
			$insert="insert into users_chat(sender_username,receiver_username,msg_content,msg_status,msg_date) values('$user_name','$username','$msg','unread',NOW())";
			$run_insert=mysqli_query($con,$insert);
		}
		$msg="";
	}?>
			<div class="row">
				<div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
					<?php
						
						$update_msg=mysqli_query($con,"update users_chat set msg_status='read' where sender_username='$username' AND receiver_username='$user_name'");
						$sel_msg="select * from users_chat where (sender_username='$user_name' and receiver_username='$username') or (receiver_username='$user_name' and sender_username='$username') order by 1 asc";
						$run_msg=mysqli_query($con,$sel_msg);
						while($row=mysqli_fetch_array($run_msg))
						{
							$sender_username=$row['sender_username'];
							$receiver_username=$row['receiver_username'];
							$msg_content=$row['msg_content'];
							$msg_date=$row['msg_date'];
					?>
					<ul>
					<?php
						if($user_name==$sender_username and $username==$receiver_username)
						{
							echo "
									<li>
										<div class='rightside-right-chat'>
											<span>$username <small>$msg_date </small></span>
											<br>
											<p><strong>$msg_content</strong></p>
										</div>
									</li>
								";
						}
						else if($user_name==$receiver_username and $username==$sender_username)
						{
							echo "
									<li>
										<div class='rightside-left-chat'>
											<span>$username <small>$msg_date</small></span>
											<br>
											<p><strong>$msg_content</strong></p>
										</div>
									</li>
								";
						}
					?>
					</ul>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 right-chat-textbox">
					<form method="post" action="home.php?user_name=<?php echo $username; ?>">
						<input autocomplete="off" type="text" name="msg_content" placeholder="Write your message...">
						<button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$('#scrolling_to_bottom').animate({
scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight},1000);
</script>
<script type="text/javascript">
$(document).ready(function(){
	var height=$(window).height();
	$('.left-chat').css('height',(height-92)+'px');
	$('.right-header-contentChat').css('height',(height-163)+'px');
});
</script>

</body>
</html>
<?php } ?>
