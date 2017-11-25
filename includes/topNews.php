<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-07 18:48:33
 */

$topNews = viewTopNews(4);

if($topNews){
?>
<div class="row">
	<div class="col-md-3">
		<div class="card"> <img class="img-fluid" src="uploads/images/<?php echo $topNews[0]['images'][0]; ?>" alt="">
			<div class="card-img-overlay"> <span class="tag tag-pill tag-danger"><?php echo ucwords($topNews[0]['category']); ?></span> </div>
			<div class="card-block">
			<div class="news-title">
				<h2 class=" title-small"><a href="details.php?id=<?php echo $topNews[0]['id']; ?>"> <?php echo ucwords($topNews[0]['title']); ?></a></h2>
			</div>
			<p class="card-text"><small class="text-time"><em><?php echo $topNews[0]['date']; ?></em></small></p>
			</div>
		</div>
		<div class="card"> <img class="img-fluid" src="uploads/images/<?php echo $topNews[1]['images'][0]; ?>" alt="">
			<div class="card-img-overlay"> <span class="tag tag-pill tag-danger"><?php echo ucwords($topNews[1]['category']); ?></span> </div>
			<div class="card-block">
			<div class="news-title">
				<h2 class=" title-small"><a href="details.php?id=<?php echo $topNews[1][3]; ?>"><?php echo ucwords($topNews[1]['title']); ?></a></h2>
			</div>
			<p class="card-text"><small class="text-time"><em><?php echo $topNews[1]['date']; ?></em></small></p>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card"> <img class="img-fluid" src="uploads/images/<?php echo $topNews[2]['images'][0]; ?>" alt="">
			<div class="card-img-overlay"> <span class="tag tag-pill tag-danger"><?php echo ucwords($topNews[2]['category']); ?></span> </div>
			<div class="card-block">
			<div class="news-title">
				<h2 class=" title-small"><a href="details.php?id=<?php echo $topNews[2]['id']; ?>"><?php echo ucwords($topNews[2]['title']); ?></a></h2>
			</div>
			<p class="card-text"><small class="text-time"><em><?php echo $topNews[2]['date']; ?></em></small></p>
			</div>
		</div>
		<div class="card"> <img class="img-fluid" src="uploads/images/<?php echo $topNews[3]['images'][0]; ?>" alt="">
			<div class="card-img-overlay"> <span class="tag tag-pill tag-danger"><?php echo ucwords($topNews[3]['category']); ?></span> </div>
			<div class="card-block">
			<div class="news-title">
				<h2 class=" title-small"><a href="details.php?id=<?php echo $topNews[3]['id']; ?>"><?php echo ucwords($topNews[3]['title']); ?></a></h2>
			</div>
			<p class="card-text"><small class="text-time"><em><?php echo $topNews[3]['date']; ?></em></small></p>
			</div>
		</div>
	</div>
<?php 
}
?>