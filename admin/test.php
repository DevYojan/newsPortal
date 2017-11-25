<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-25 10:33:00
 */

include 'includes/config.php';
include 'includes/db.php';
include 'includes/functions.php';

$limit = 5;

	$sql = "SELECT news.id, news.title, news.news_date as date, news_images.image_name as image FROM news LEFT JOIN news_images ON news_images.news_id=news.id WHERE news.status=0 AND news.featured=0 GROUP BY news_images.news_id ORDER BY news.news_date DESC limit ".$limit;
	debugger($sql, true);