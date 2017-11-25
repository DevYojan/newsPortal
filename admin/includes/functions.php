<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-16 01:16:22
 */

function debugger($data, $is_die=false){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	
	if($is_die){
		exit;
	}
}

function sanitize($data){
	if(get_magic_quotes_gpc()){
		$data = trim(stripslashes($data));
	} else {
		$data = addslashes($data);
	}

	$data = strip_tags($data);
	$data = trim($data);

	return $data;
}

function isAvailable($table, $field, $data){
	/*
		Returns true if the given data is available in the given field of given table, false otherwise.
	*/

	global $conn;

	$sql = "SELECT * FROM ".$table." WHERE ".$field."='".$data."'";
	$query = mysqli_query($conn, $sql);

	if(mysqli_num_rows($query) > 0){
		$user_info = mysqli_fetch_assoc($query);
		return $user_info;
	} else {
		return null;
	}
}

function addCategory($title, $status, $update=false, $id=''){
	global $conn;

	if($update == true){
		$sql = "UPDATE categories SET title='".$title."', status=".$status." WHERE id=".$id;
	} else {
		$sql = "INSERT INTO categories SET title='".$title."', status=".$status;
	}
	
	$query = mysqli_query($conn, $sql);

	if($query){
		return true;
	} else {
		return false;
	}
}

function addUser($username, $password, $full_name, $address, $role, $status, $update=false, $id=''){
	global $conn;

	if($update){
		$sql = "UPDATE users SET username='".$username."', password='".sha1($username.$password)."', full_name='".$full_name."', address='".$address."', roll_id='".$role."', status='".$status."' WHERE id=".$id;
	} else {
		$sql = "INSERT INTO users SET username='".$username."', password='".sha1($username.$password)."', full_name='".$full_name."', address='".$address."', roll_id='".$role."', status='".$status."'";
	}
	
	$query = mysqli_query($conn, $sql);

	if($query){
		return true;
	} else {
		return false;
	}
}

function listAll($tableName, $order=''){
	global $conn;

	if($order == ''){
		$sql = "SELECT * FROM ".$tableName;
	} else {
		$sql = "SELECT * FROM ".$tableName." ".$order;
	}
	
	$query = mysqli_query($conn, $sql);

	if($query){
		if(mysqli_num_rows($query) > 0){
			$categories = array();
			while($row = mysqli_fetch_assoc($query)){
				$categories[] = $row;
			}

			return $categories;
		} else {
			return null;
		}
	} else {
		$_SESSION['error'] = 'Can\'t list '.ucwords($tableName).' at this moment.';
	}
}

function deleteData($tableName, $field, $data){
	global $conn;

	$sql = "DELETE FROM ".$tableName." WHERE ".$field."=".$data;
	$query = mysqli_query($conn, $sql);

	if($query){
		return true;
	} else {
		return false;
	}
}

function newsList($order=''){
	global $conn;
	$sql = "SELECT news.id, news.title, news.added_by, news.description, news.status, news.added_date, categories.title AS category, users.full_name as reporter FROM news LEFT JOIN categories ON news.category_id = categories.id LEFT JOIN users ON news.reporter_id = users.id ".$order;
	$query = mysqli_query($conn, $sql);

	if($query){
		if(mysqli_num_rows($query) > 0){
			$allNews = array();
			while($row = mysqli_fetch_assoc($query)){
				$allNews[] = $row;
			}

			return $allNews;
		} else {
			return null;
		}
	} else {
		$_SESSION['error'] = 'Can\'t list news at this moment.';
		@header('location: dashboard.php');
		exit;
	}
}

function politicalNews($order = ''){
	global $conn;

	$allNews = listAll('news', 'WHERE status=0 ORDER BY id DESC');

	if($allNews){
		$topNews = array();
		$oneNews = array();
		foreach ($allNews as $key => $news) {
			$cat_id = $news['category_id'];

			$sql1 = "SELECT * FROM categories WHERE id=".$cat_id;
			$query = mysqli_query($conn, $sql1);

			$result = mysqli_fetch_assoc($query);

			if(strtolower($result['title']) == 'politics'){
				$image = isAvailable('news_images', 'news_id', $news['id']);
				if($image){
					$oneNews[] = $image['image_name'];
				} else {
					$oneNews[] = 'news.jpg';
				}

				$oneNews[] = $news['title'];
				$oneNews[] = $news['description'];
				$oneNews[] = $news['id'];

				$topNews[] = $oneNews;
				$oneNews = array();
			}
		}
		return $topNews;
	}
}

function internationalNews($order = ''){
	global $conn;

	$allNews = listAll('news', 'WHERE status=0 ORDER BY id DESC');

	if($allNews){
		$topNews = array();
		$oneNews = array();
		foreach ($allNews as $key => $news) {
			$cat_id = $news['category_id'];

			$sql1 = "SELECT * FROM categories WHERE id=".$cat_id;
			$query = mysqli_query($conn, $sql1);

			$result = mysqli_fetch_assoc($query);

			if(strtolower($result['title']) == 'international'){
				$image = isAvailable('news_images', 'news_id', $news['id']);
				if($image){
					$oneNews[] = $image['image_name'];
				} else {
					$oneNews[] = 'news.jpg';
				}

				$oneNews[] = $news['title'];
				$oneNews[] = $news['added_date'];
				$oneNews[] = $news['id'];

				$topNews[] = $oneNews;
				$oneNews = array();
			}
		}
		return $topNews;
	}
}

function imageGallery($order = ''){
	global $conn;

	$sql = "SELECT * FROM news_images GROUP BY news_id ".$order;
	$query = mysqli_query($conn, $sql);

	if(mysqli_num_rows($query) > 0){
		$images = array();
		while($row = mysqli_fetch_assoc($query)){
			$images[] = $row;
		}

		$oneImage = array();
		$allImages = array();

		foreach ($images as $key => $image) {
			$sql1 = "SELECT * FROM news WHERE id=".$image['news_id'];
			$query1 = mysqli_query($conn, $sql1);

			$info = mysqli_fetch_assoc($query1);

			$oneImage[] = $image['image_name'];
			$oneImage[] = $info['title'];

			$allImages[] = $oneImage;
			$oneImage = array();

		}

		return $allImages;
	}
}

function viewTopNews($limit=5 ,$category=''){
	global $conn;

	$sql = "SELECT news.id, news.title, news.description, news.added_date, categories.title as category, categories.id as cat_id, users.full_name as reporter FROM news LEFT JOIN categories ON categories.id=news.category_id LEFT JOIN users ON users.id=news.reporter_id WHERE news.status=0 order by id desc limit ".$limit;

	$query = mysqli_query($conn, $sql);

	if(mysqli_num_rows($query) > 0){
		$topNews = array();
		$allNews = array();
		$finalNews = array();
		
		while($row = mysqli_fetch_assoc($query)){
			$topNews[] = $row;
		}

		if($category != ''){
			if($category == 'politics'){
				${$category.'News'} = array();

				foreach ($topNews as $key => $value) {
					if(strtolower($value['category']) == $category){
						${$category.'News'}[] = $value;
					}
				}

				$topNews = ${$category.'News'};
			}
		}

		foreach ($topNews as $key => $news) {
			$id = $news['id'];

			$sql1 = "SELECT * FROM news_images WHERE news_id=".$id;
			$query1 = mysqli_query($conn, $sql1);

			$allImages = array();

			if(mysqli_num_rows($query1) > 0){
				while($row = mysqli_fetch_assoc($query1)){
					$allImages[] = $row['image_name'];
				}
			} else {
				$allImages[] = 'news.jpg';
			}

			$allNews = array(
							'id' => $news['id'],
							'title' => $news['title'],
							'category' => $news['category'],
							'cat_id' => $news['cat_id'],
							'reporter' => $news['reporter'],
							'description' => $news['description'],
							'date' => dateCalculator($news['added_date']),
							'images' => $allImages 
						);

			$finalNews[] = $allNews;
		}

		return $finalNews;

	} else {
		return null;
	}
}

function viewNews($id){
	global $conn;

	$id = sanitize($id);
	$check = isAvailable('news', 'id', $id);

	if($check){
		$sql = "SELECT news.id, news.title, news.description, news.added_date as date, categories.title as category, users.full_name as reporter FROM news LEFT JOIN categories ON categories.id=news.category_id LEFT JOIN users ON users.id=news.reporter_id WHERE news.status=0 AND news.id=".$id;
		$query = mysqli_query($conn, $sql);

		$news = mysqli_fetch_assoc($query);

		$news['date'] = date('Y-m-d', strtotime($news['date']));
		if($news['reporter'] == ''){
			$news['reporter'] = 'News Reporter';
		}

		$sql = "SELECT * FROM news_images WHERE news_id=".$news['id'];
		$query = mysqli_query($conn, $sql);

		$images = array();
		if(mysqli_num_rows($query) > 0){
			while($row = mysqli_fetch_assoc($query)){
				$images[] = $row['image_name'];
			}
		} else {
			$images[] = 'news.jpg';
		}

		$news['images'] = $images;

		return $news;

	} else {
		return null;
	}

}

function dateCalculator($date){

	date_default_timezone_set('Asia/Kathmandu');

	$date = date_create_from_format('Y-m-d H:i:s', $date);

	$currentDate = new DateTime;

	$difference = $currentDate -> diff($date);

	$unit = 'second';
	$count = $difference->s;

	switch (true){
		case $difference->y > 0:
			$unit = 'year';
			$count = $difference->y;
			break;

		case $difference->m > 0:
			$unit = 'month';
			$count = $difference->m;
			break;

		case $difference->d > 0:
			$unit = 'day';
			$count = $difference->d;
			break;

		case $difference->h > 0:
			$unit = 'hour';
			$count = $difference->h;
			break;

		case $difference->m > 0:
			$unit = 'min';
			$count = $difference->m;
			break;
	}

	if($count == 0){
		$count = 1;
	}

	if($count != 1){
		$unit .= 's';
	}

	$comment = $difference->invert == 0 ? 'From Now' : 'ago';

	return "{$count} {$unit} {$comment}";
}

function increaseHits($id){
	global $conn;

	$id = sanitize($id);

	$sql = "UPDATE hits SET clicks=clicks+1 WHERE news_id=".$id;
	$query = mysqli_query($conn, $sql);
}

function featuredPosts($limit = 5){
	global $conn;

	$sql = "SELECT news.id, news.title, news.news_date as date, news_images.image_name as image FROM news LEFT JOIN news_images ON news_images.news_id=news.id WHERE news.status=0 AND news.featured=0 GROUP BY news_images.news_id ORDER BY news.news_date DESC limit ".$limit;
	$query = mysqli_query($conn, $sql);

	$featured = array();

	while($row = mysqli_fetch_assoc($query)){
		if($row['image'] == ''){
			$row['image'] = 'news.jpg';
		}

		$row['date'] = dateCalculator($row['date']);

		$featured[] = $row;
	}

	return $featured;
}

function topNews($limit = 5){
	global $conn;

	$sql = "SELECT news.id, news.title, news.news_date as date, news_images.image_name as image, hits.clicks FROM news LEFT JOIN news_images ON news.id=news_images.news_id LEFT JOIN hits ON news.id=hits.news_id WHERE news.status=0 ORDER BY hits.clicks desc, news.news_date desc limit ".$limit;
	$query = mysqli_query($conn, $sql);

	$topNews = array();
	while($row = mysqli_fetch_assoc($query)){
		if($row['image'] == ''){
			$row['image'] = 'news.jpg';
		}

		$row['date'] = dateCalculator($row['date']);
		$topNews[] = $row;
	}

	$news = array();

	return $topNews;
}
