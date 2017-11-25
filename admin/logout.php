<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-17 17:47:59
 * @Last Modified by:   Adman
 * @Last Modified time: 2017-09-17 17:48:35
 */
session_start();
session_destroy();
@header('location: index.php');
exit;