<?php
	include 'MySiteActivity.php';
	session_start();
	$activity = new MySiteActivity();
	//session_start();
	$login_session=$_SESSION['login_user'];
	$activity->run($login_session);
?>