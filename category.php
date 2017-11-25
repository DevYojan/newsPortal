<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-09 16:49:22
 */

include 'admin/includes/config.php';
include 'admin/includes/db.php';
include 'admin/includes/functions.php';

if(isset($_GET['id']) && $_GET['id'] != ''){
	$id = sanitize($_GET['id']);

	$category = isAvailable('categories', 'id', $id);

	if(!$category){
		@header('location: index.php');
		exit;
	}

	if($category['status'] == 1){
		@header('location: index.php');
		exit;
	}

	$news = listAll('news', 'WHERE status=0 AND category_id='.$category['id']);

	if($news){
		$allNews = array();
		$one = array();
		foreach ($news as $key => $singleNews) {
			$id = $singleNews['id'];
			$image = isAvailable('news_images', 'news_id', $id);
			if($image){
				$one = array(
						'id' => $singleNews['id'],
						'title' => $singleNews['title'],
						'description' => $singleNews['description'],
						'image' => $image['image_name']
						);

				$allNews[] = $one;
				$one = [];
			}
		}
	}

} else {
	@header('location: index.php');
	exit;
}

include 'includes/header.php';
?>
<style type="text/css">
	img{
		max-height: 300px;
		margin-bottom: 5px;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<?php
				for($i=0; $i<count($allNews); $i++){
					?>
					<a href="details.php?id=<?php echo $allNews[$i]['id']; ?>"><h2 class="alert-success"><?php echo ucwords($allNews[$i]['title']); ?></h2></a>
					<img src="uploads/images/<?php echo $allNews[$i]['image']; ?>" class="img img-responsive">
					<p class="alert-info"><?php echo ucfirst(implode(' ', array_slice(explode(' ', $allNews[$i]['description']), 0, 40))).' ....'; ?></p>
					<hr />
					<?php
				}
			?>
		</div>
	</div>
</div>
<?php
include 'includes/footerNav.php';
include 'includes/footer.php';
?>