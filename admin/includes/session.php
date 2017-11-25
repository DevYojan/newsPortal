<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-16 16:22:33
 */

if(!(isset($_SESSION))){
	session_start();
}

if(!isset($_SESSION['id']) || !isset($_SESSION['full_name'])){
	unset($_SESSION['id']);
	unset($_SESSION['full_name']);

	$_SESSION['error'] = 'Unauthorized access.';
	@header('location: index.php');
	exit;
}