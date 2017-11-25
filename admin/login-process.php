<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-16 01:12:49
 */

session_start();

require 'includes/config.php';
require 'includes/db.php';
require 'includes/functions.php';

if(isset($_POST) && !empty($_POST)){
	if($_POST['username'] != ''){
		if($_POST['password'] != ''){
			$username = sanitize($_POST['username']);

			$user_info = isAvailable('users', 'username', $username);

			if($user_info){
				$password = sha1($_POST['username'].$_POST['password']);

				if($user_info['password'] == $password){
					$_SESSION['success'] = 'You are welcome '.$user_info['username'];
					$_SESSION['id'] = $user_info['id'];
					$_SESSION['full_name'] = $user_info['full_name'];
					@header('location: dashboard.php');
					exit;
				} else {
					$_SESSION['error'] = 'The password you entered is incorrect.';
					@header('location: index.php');
					exit;
				}
			} else {
				$_SESSION['error'] = 'The username you entered does not exists.';
				@header('location: index.php');
				exit;
			}

		} else {
			$_SESSION['error'] = 'Username is required to log in.';
			@header('location: index.php');
			exit;
		}
	} else {
		$_SESSION['error'] = 'Username is required to log in.';
		@header('location: index.php');
		exit;
	}
} else {
	$_SESSION['error'] = 'Please login first.';
	@header('location: index.php');
	exit;
}

?>