<?php require_once("connection.php");
require_once("header.php"); ?>

<h1>Register</h1>
<form action="index.php" method="post">
	<div class="form-group form-horizontal text-center" style="width:50%; margin:0 auto">
	<label for="username">Username: </label>
	<input type="text" name="username" class="form-control"><br>
	<label for="password">Password: </label>
	<input type="password" name="password" class="form-control"><br>
	<label for="phone">Phone number: </label>
	<input type="text" name="phone" class="form-control"><br>
	<input type="submit" value="Register" class="btn btn-info">
	</div>
</form>
 
<?php

if(isset($_POST['username'])&&empty($_POST['username'])) {
	echo "<h2>You need to insert a username!</h2>";
} elseif(isset($_POST['password'])&&empty($_POST['password'])){
	echo "<h2>You need to insert a password!</h2>";
}
else {
	if(isset($_POST['username'])&&
			!empty($_POST['username']&&
			$_POST['password']&&
			$_POST['phone']
		)){
			//sanitize inputs
			$sanitized_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING); 
			$sanitized_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
			$sanitized_phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
			
			$res=$dbh->query("SELECT USERNAME FROM 6470exerciseusers WHERE USERNAME='".$sanitized_username."'");

		if($res->num_rows>0) {
		    printf("<h2>The name you entered is already registered!Try again!</h2>");  
		} else {
				$sql="INSERT INTO 6470exerciseusers(USERNAME, PASSWORD_HASH, PHONE) 
				VALUES('".$sanitized_username."','".$sanitized_password."', '".$sanitized_phone."')";

				if($dbh->query($sql) === FALSE) {
					die("Error: " . $sql . "<br>" . $dbh->error);
				}
			    	
					echo "<h2>You have successfully registered with the name <strong>". $sanitized_username. "</strong> and the phone <strong>".$sanitized_phone. "</strong>!</h2>";
			}
	}
}


require_once("footer.php");