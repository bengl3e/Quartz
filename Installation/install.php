<?php
	include 'InstallationActivity.php';
	session_start();
	$activity = new InstallationActivity();
	$activity->run();
?>