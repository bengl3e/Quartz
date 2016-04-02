<?php

	include 'RegistrationActivity.php';
	
	session_start();

	$activity = new RegistrationActivity();

	$activity->run();

?>
