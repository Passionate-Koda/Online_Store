<?php
session_start();

	//include '../includes/db.php';

	session_destroy();

		header("Location:index.php");
?>
