<?php
	include("include/connection.php");
	$user="select * from users";
	$run_user=mysqli_query($con,$user);
	while($row_user=mysqli_fetch_array($run_user))
	{
		$user_id=$row_user['user_id'];
		$user_name=$row_user['user_name'];
		$user_profile=$row_user['user_profile'];
		$login=$row_user['log_in'];
		echo "
			<li>
				<div class='chat-left-img'>
					<img src='$user_profile'>
				</div>
				<div class='chat-left-detail'>
					<p>&nbsp&nbsp&nbsp&nbsp<a class='un' href='home.php?user_name=$user_name'>$user_name</a></p>";
					if($login=='Online')
						echo "<span>&nbsp&nbsp&nbsp&nbsp<i class='fa fa-circle circ' aria-hidden='true'></i><strong>&nbspOnline</strong></span>";
					else
						echo "<span>&nbsp&nbsp&nbsp&nbsp<i class='fa fa-circle-o circ' aria-hidden='true'></i><strong>&nbspOffline</strong></span>";
				"</div>
			</li>
		";
	
	}
?>