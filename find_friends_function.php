<?php
include("include/connection.php");
function search_user(){
	global $con;
	if(isset($_POST['search-btn'])){
		$search_query=htmlentities($_POST['search_query']);
		$get_user="select * from users where user_name like '%$search_query%' or user_country like '%$search_query%'";
	}
	else{
		$get_user="select * from users order by user_country,user_name desc limit 5";
	}
	$run_user=mysqli_query($con,$get_user);
	while($row_user=mysqli_fetch_array($run_user))
	{
		$user_id=$row_user['user_id'];
		$user_name=$row_user['user_name'];
		$user_profile=$row_user['user_profile'];
		$country=$row_user['user_country'];
		$gender=$row_user['user_gender'];
		echo "
			<div class='card'>
				<img src='$user_profile'>
				<h1>$user_name</h1>
				<p class='title'>$country</p>
				<p>$gender</p>
				<form method='post' action='home.php?user_name=$user_name'>
					<p><button name='add'>Chat with $user_name</button></p>
				</form>
			</div><br><br>
		";
	}
}
?>
