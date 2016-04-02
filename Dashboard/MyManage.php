<?php
	include 'ManageActivity.php';
	session_start();
	$activity = new MyManageActivity();
	$activity->show();
?>