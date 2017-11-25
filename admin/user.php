<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-24 09:52:55
 */
session_start();

require 'includes/config.php';
require 'includes/db.php';
require 'includes/functions.php';

if(isset($_POST) && !empty($_POST)){
	if($_POST['full_name'] != ''){
		if($_POST['address'] != ''){
			if($_POST['password'] != ''){
				if($_POST['username'] != ''){
					if($_POST['role'] == 0 || $_POST['role'] == 1){
						if($_POST['status'] == 0 || $_POST['status'] == 1){
							
							$username = sanitize($_POST['username']);
							$password = sanitize($_POST['password']);
							$full_name = ucwords(sanitize($_POST['full_name']));
							$address = ucwords(sanitize($_POST['address']));
							$role = sanitize($_POST['role']);
							$status = sanitize($_POST['status']);

							if(isset($_POST['id']) && $_POST['id'] != ''){
								$id = sanitize($_POST['id']);
								$check = isAvailable('users', 'id', $id);

								if($check){
									$act = 'updat';
								}

								$add = addUser($username, $password, $full_name, $address, $role, $status, true, $id);

							} else {
								$act = 'add';
								$alreadyExists = isAvailable('users', 'username', $username);

								if($alreadyExists){
									$_SESSION['error'] 
									= 'Username already exists. Please select a different username.';
									@header('location: user-add.php');
									exit;
								}

								$add = addUser($username, $password, $full_name, $address, $role, $status);

							}


							if($add){
								$_SESSION['success'] = 'User '.$act.'ed successfully.';
							} else {
								if($act=='updat'){
									$act = 'update';
								} else {
									$act = 'add';
								}
								$_SESSION['error'] = 'Can\'t '.$act.' user at this moment.';
							}

							@header('location: user-list.php');
							exit;

						} else {
							$_SESSION['error'] = 'Please select a status.';
							@header('location: user-add.php');
							exit;
						}
					} else {
						$_SESSION['error'] = 'Please select a role.';
						@header('location: user-add.php');
						exit;
					}
				} else {
					$_SESSION['error'] = 'Please enter a username.';
					@header('location: user-add.php');
					exit;
				}
			} else {
				$_SESSION['error'] = 'Please enter a password.';
				@header('location: user-add.php');
				exit;
			}
		} else {
			$_SESSION['error'] = 'Please enter address of the user.';
			@header('location: user-add.php');
			exit;
		}
	} else {
		$_SESSION['error'] = 'Please enter full name of the user.';
		@header('location: user-add.php');
		exit;
	}
} else if(isset($_GET['id']) && $_GET['id'] != ''){
	$id = sanitize($_GET['id']);
	$check = isAvailable('users', 'id', $id);

	if($check){
		$delete = deleteData('users', 'id', $id);

		if($delete){
			$_SESSION['success'] = 'User deleted successfully';
		} else {
			$_SESSION['error'] = 'Can\'t delete user at this moment.';
		}

		@header('location: user-list.php');
		exit;
	}
} else {
	$_SESSION['error'] = 'Please fill the form first.';
	@header('location: user-add.php');
	exit;
}