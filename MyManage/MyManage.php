<?php
	include 'ManageActivity.php';
	session_start();
	$email = $_SESSION['logined-user'];
	$activity = new MyManageActivity();
	$activity->run($email);
?>