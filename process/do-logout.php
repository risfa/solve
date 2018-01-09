<?php
	include "db/db.php";
	
	session_destroy();
	
	header("location:../login.php");
?>