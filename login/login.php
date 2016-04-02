<?php
	include 'LoginActivity.php';
	session_start();
	$activity = new LoginActivity();
	$activity->run();
?>