<?php
	include 'UninstallActivity.php';
	session_start();
	$activity = new UninstallActivity();
	$activity->run();
?>
