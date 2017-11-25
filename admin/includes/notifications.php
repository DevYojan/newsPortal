<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-16 15:42:58
 * @Last Modified by:   Adman
 * @Last Modified time: 2017-09-17 17:52:20
 */

//include 'session.php';

if(isset($_SESSION['error']) && $_SESSION['error'] != ''){
	echo "<p class='alert-danger'>{$_SESSION['error']}</p>";
	unset($_SESSION['error']);
}

if(isset($_SESSION['warning']) && $_SESSION['warning'] != ''){
	echo "<p class='alert-warning'>{$_SESSION['warning']}</p>";
	unset($_SESSION['warning']);
}

if(isset($_SESSION['success']) && $_SESSION['success'] != ''){
	echo "<p class='alert-success'>{$_SESSION['success']}</p>";
	unset($_SESSION['success']);
}