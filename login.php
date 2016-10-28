<?php require_once("connection.php"); 
require_once("header.php"); ?>

<h1>Login</h1>
<form action="login.php" method="POST">
	<div class="form-group form-horizontal text-center" style="width:50%; margin:0 auto">
	<label for="username">Username: </label>
	<input type="text" name="username" class="form-control"><br>
	<label for="password">Password: </label>
	<input type="password" name="password" class="form-control"><br>
	<input class="btn btn-info" type="submit" name="submit" value="Login">
	</div>
</form>
<?php

if(isset($_POST['username'])&&
		!empty($_POST['username']&&
		$_POST['password']
	)){
		//sanitize inputs
		$sanitized_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING); 
		$sanitized_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

		$sql_user=$dbh->query("SELECT USERNAME FROM 6470exerciseusers WHERE USERNAME='".$sanitized_username."'");
		$sql_pass=$dbh->query("SELECT PASSWORD_HASH FROM 6470exerciseusers WHERE PASSWORD_HASH='".$sanitized_password."'");

		if($sql_user->num_rows>0 && $sql_pass->num_rows>0){
			$_SESSION['loggedin']=$sanitized_username;
			header("location: profile.php");
		    echo "<h1>Welcome!</h1>"; 
			}
		else{
			echo "<h2>Invalid username or password!</h2>";
			}
}
require_once("footer.php");