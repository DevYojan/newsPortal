<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-17 22:05:18
 */
session_start();

require 'includes/config.php';
require 'includes/db.php';
require 'includes/functions.php';

if(isset($_POST) && !empty($_POST)){
	if(!empty($_POST['category_name'])){
		if($_POST['category_status'] != ''){
			$category_name = strtolower(sanitize($_POST['category_name']));
			$category_status = sanitize($_POST['category_status']);

			if(isset($_POST['id']) && $_POST['id'] != ''){
				$id = sanitize($_POST['id']);
				$category = isAvailable('categories', 'id', $id);
				
				if($category){
					$act = 'updat';
					$insert = addCategory($category_name, $category_status, true, $id);
				}
			} else {
				$act = 'add';
				$check = isAvailable('categories', 'title', $category_name);

				if($check){
					$_SESSION['error'] = 'Category already exists!';
					@header('location: category-list.php');
					exit;
				}
				
				$insert = addCategory($category_name, $category_status);
			} 

			if($insert){
				$_SESSION['success'] = 'Category '.ucwords($act).'ed Successfully.';
			} else {
				$_SESSION['error'] = 'Can\'t '.ucwords($act).'e category at this moment.';
			}
			@header('location: category-list.php');
			exit;

		} else {
			$_SESSION['error'] = 'Please select the category status.';
			@header('location: category-add.php');
			exit;
		}
	} else {
		$_SESSION['error'] = 'Please fill the name of the category.';
		@header('location: category-add.php');
		exit;
	}
} else if(isset($_GET['id']) && $_GET['id'] != ''){
	$id = sanitize($_GET['id']);
	$check = isAvailable('categories', 'id', $id);

	if($check){
		$del = deleteData('categories', 'id', $id);

		if($del){
			$_SESSION['success'] = 'Category deleted successfully';
		} else {
			$_SESSION['error'] = 'Can\'t delete category at this moment.';
		}

		@header('location: category-list.php');
		exit;
	} else {
		$_SESSION['error'] = 'Category you are trying to delete does not exists.';
	}
} else {
	$_SESSION['error'] = 'Please fill the form first.';
	@header('location: category-add.php');
	exit;
}
