<?php
	// requires php5
	session_start();
	session_destroy();
	header("Location:home.php");
?>