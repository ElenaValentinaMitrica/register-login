<?php
require_once ("connection.php");

require_once ("header.php");
 ?>

<h1>Change password</h1>
<form action="change-password.php" method="post">
	<div class="form-group form-horizontal text-center" style="width:50%; margin:0 auto">
	<label for="username">Username: </label>
	<input type="text" name="username" class="form-control"><br />
	<label for="password">Password: </label>
	<input type="password" name="password" class="form-control"><br />
	<label for="phone">New password: </label>
	<input type="password" name="new-password" class="form-control"><br />
	<input type="submit" value="Change password" class="btn btn-info">
	</div>
</form>
<?php

if (isset($_POST['username']) && !empty($_POST['username'] && $_POST['password']))
	{

	// sanitize inputs

	$sanitized_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$sanitized_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$sql_user = $dbh->query("SELECT USERNAME FROM 6470exerciseusers WHERE USERNAME='" . $sanitized_username . "'");
	$sql_password = $dbh->query("SELECT PASSWORD_HASH FROM 6470exerciseusers WHERE PASSWORD_HASH='" . $sanitized_password . "'");
	if ($sql_user->num_rows > 0 && $sql_password->num_rows > 0)
		{
		$sql = "UPDATE 6470exerciseusers SET PASSWORD_HASH ='" . $_POST['new-password'] . "' WHERE USERNAME='" . $sanitized_username . "' AND PASSWORD_HASH='" . $sanitized_password . "'";
		if ($dbh->query($sql) === FALSE)
			{
			die("Error: " . $sql . "<br />" . $dbh->error);
			}

		echo "The password was successfully changed!";
		}
	  else
		{
		echo "Password not changed! ";
		}
	}

require_once ("footer.php");

