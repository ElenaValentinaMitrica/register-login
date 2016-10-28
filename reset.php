<?php
require_once ("connection.php");

require_once ("header.php");
 ?>
<h1>Reset password!</h1>
<form action="reset.php" method="post">
	<div class="form-group form-horizontal text-center" style="width:50%; margin:0 auto">
	<label for="username">Username: </label>
	<input type="text" name="username" class="form-control"><br />
	<label for="phone">Phone number: </label>
	<input type="text" name="phone" class="form-control"><br />
	<input type="submit" value="Reset" class="btn btn-info">
	</div>
</form>

<?php

if (isset($_POST['username']) && !empty($_POST['username'] && $_POST['phone']))
	{

	// sanitize inputs

	$sanitized_username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$sanitized_phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
	$sql_user = $dbh->query("SELECT USERNAME FROM 6470exerciseusers WHERE USERNAME='" . $sanitized_username . "'");
	$sql_phone = $dbh->query("SELECT PHONE FROM 6470exerciseusers WHERE PHONE='" . $sanitized_phone . "'");
	function generateRandomString($length = 10)
		{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++)
			{
			$randomString.= $characters[rand(0, $charactersLength - 1) ];
			}

		return $randomString;
		}

	if ($sql_user->num_rows > 0 && $sql_phone->num_rows > 0)
		{
		$sql = "UPDATE 6470exerciseusers SET PASSWORD_HASH ='" . generateRandomString($length = 10) . "' WHERE USERNAME='" . $sanitized_username . "' AND PHONE='" . $sanitized_phone . "'";
		if ($dbh->query($sql) === FALSE)
			{
			die("Error: " . $sql . "<br />" . $dbh->error);
			}
		}
	  else
		{
		echo "<h2>Fail to reset the password!</h2>";
		}
	}

require_once ("footer.php");

