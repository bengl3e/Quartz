<?php
	include 'DashboardActivity.php';
	session_start();
	$activity = new DashboardActivity();
	$activity->run();
?>