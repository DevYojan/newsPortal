<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-28 14:57:42
 */

require 'includes/session.php';
require 'includes/config.php';
require 'includes/db.php';
require 'includes/functions.php';

if(isset($_POST) && !empty($_POST)){
	if($_POST['news_date'] != ''){
		if($_POST['news_location'] != ''){
			if($_POST['news_title'] != ''){
				if($_POST['news_summary'] != ''){
					if($_POST['news_description'] != ''){
						if($_POST['news_category'] != ''){
							if($_POST['news_status'] == 0 || $_POST['news_status'] == 1){
								if($_POST['news_reporter'] != ''){

									$news_date = sanitize($_POST['news_date']);
									$news_location = sanitize($_POST['news_location']);
									$news_title = sanitize($_POST['news_title']);
									$news_summary = sanitize($_POST['news_summary']);
									$news_description = sanitize($_POST['news_description']);
									$news_category = sanitize($_POST['news_category']);
									$news_status = sanitize($_POST['news_status']);
									$news_reporter = sanitize($_POST['news_reporter']);
									$news_adder = sanitize($_SESSION['full_name']);
									$featured = (isset($_POST['featured']) && $_POST['featured'] == 'on')?0:1;

									if(isset($_POST['id']) && $_POST['id'] != ''){
										$editId = sanitize($_POST['id']);

										$first = "UPDATE news ";
										$last = "WHERE id=".$editId;
										$act = "updat";
										$id = $editId;
										
									} else {
										$first = "INSERT INTO news ";
										$last = "";
										$act = "add";
									}
									
									$sql = $first."SET title='".$news_title."', summary='".$news_summary."', description='".$news_description."', category_id='".$news_category."', status='".$news_status."', reporter_id='".$news_reporter."', location='".$news_location."', news_date='".$news_date."', added_by='".$news_adder."'".$last.", featured=".$featured;

									$query = mysqli_query($conn, $sql);

									if($query){
										
										$id = ($act == 'add')?mysqli_insert_id($conn):$editId;

										if($act == 'add'){
											$hitsSql = "INSERT INTO hits SET news_id=".$id.", category_id=".$news_category.", clicks=0";
											$hitsQuery = mysqli_query($conn, $hitsSql);
										}

										if($act=='updat'){
											if(isset($_POST['delete'])){
												$del = $_POST['delete'];
												foreach ($del as $image) {
													$sql = "DELETE FROM news_images WHERE image_name='".$image."'";
													$query = mysqli_query($conn, $sql);

													if($query){
														$path = '../uploads/images/'.$image;
														if(file_exists($path)){
															unlink($path);
														}
													}
												}
											}
										}
										$_SESSION['success'] = 'News '.$act.'ed successfully';

										if($_FILES['news_images']['name'][0] != ''){
											if(!is_dir('../uploads/images')){
												mkdir('../uploads/images',0755, true);
											}

											$supportedExtensions = ['jpg', 'jpeg', 'gif', 'png'];

											$images = $_FILES['news_images'];

											$count = 0;

											for($i=0; $i<count($images['name']); $i++){
												$ext = pathinfo($images['name'][$i], PATHINFO_EXTENSION);
												if(in_array(strtolower($ext), $supportedExtensions)){
													$random = 'file-'.date('Y-m-d').rand(0,999);
													$imageName = $random.'.'.$ext;
													$filename = '../uploads/images/'.$random.'.'.$ext;
													$move = move_uploaded_file($images['tmp_name'][$i], $filename);
													if($move){
														$sql1 = "INSERT INTO news_images SET image_name='".$imageName."', news_id=".$id;
														$query = mysqli_query($conn, $sql1);

														if($query){
															$count++;
														}
													}
												}
											}

											if($count > 0){
												$_SESSION['success'] = $count.' images and news '.$act.'ed successfully.';
											} else {
												$act .= ($act=='updat')?'e':'';
												$_SESSION['error'] = 'Can\'t '.$act.' images at this moment.';
											}
										}
									} else {
										$act .= ($act=='updat')?'e':'';
										$_SESSION['error'] = 'Can\'t '.$act.' news at this moment.';
									}

									@header('location: news-list.php');
									exit;
									
								} else {
									$_SESSION['warning'] = 'Please select the news reporter.';
									@header('location: news-add.php');
									exit;
								}
							} else {
								$_SESSION['warning'] = 'Please select the news status.';
								@header('location: news-add.php');
								exit;
							}
						} else {
							$_SESSION['warning'] = 'Please select the category of the news.';
							@header('location: news-add.php');
							exit;
						}
					} else {
						$_SESSION['warning'] = 'Please fill the news description.';
						@header('location: news-add.php');
						exit;
					}
				} else {
					$_SESSION['warning'] = 'Please fill the news summary.';
					@header('location: news-add.php');
					exit;
				}
			} else {
				$_SESSION['warning'] = 'Please fill the news title.';
				@header('location: news-add.php');
				exit;
			}
		} else {
			$_SESSION['warning'] = 'Please fill the news location.';
			@header('location: news-add.php');
			exit;
		}
	} else {
		$_SESSION['warning'] = 'Please enter the news date.';
		@header('location: news-add.php');
		exit;
	}
} else if(isset($_GET['id']) && $_GET['id'] != ''){
	$id = sanitize($_GET['id']);

	$news = isAvailable('news', 'id', $id);

	if($news){
		$del = deleteData('news', 'id', $id);

		if($del){
			$images = listAll('news_images', 'WHERE news_id='.$id);

			if($images){
				$count = 0;
				foreach ($images as $key => $image) {
					$sql = "DELETE FROM news_images WHERE image_name='".$image['image_name']."'";
					$query = mysqli_query($conn, $sql);

					if($query){
						$del = '../uploads/images/'.$image['image_name'];

						if(file_exists($del)){
							$deleted = unlink($del);

							if($deleted){
								$count++;
							}
						}
					}
				}

				$_SESSION['success'] = $count.' images and news deleted successfully';
			} else{
				$_SESSION['success'] = 'News deleted successfully.';
			}
		} else {
			$_SESSION['error'] = 'Can\'t delete news at this moment.';
		}
		@header('location: news-list.php');
		exit;
	} else {
		$_SESSION['error'] = 'The news you are trying to delete does not exist.';
	}
	@header('location: news-list.php');
	exit;
} else {
	$_SESSION['warning'] = 'Please fill the form first.';
	@header('location: news-add.php');
	exit;
}