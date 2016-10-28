<?php
$host="localhost";
$username="root";
$password=Null;
$dbname="6470";

$dbh=new mysqli($host, $username, $password, $dbname);
if($dbh->connect_error){
	echo "Connection error: ". $dbh->connect_error;
}
