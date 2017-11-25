<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-08 14:44:20
 */

$images = imageGallery('ORDER BY id DESC');
?>
<style type="text/css">
	
</style>
<section class="video-gallery-sec">
        <div class="container">
    <h3>
            <div class="heading-large">Today's Image Gallery</div>
          </h3>
	<div class="row">
		<?php
			for($i=0; $i<4; $i++){
				?>
				<div class="col-md-3">
			        <div class="news-block">
			            <div class="news-media"><a class="example-image-link" href="uploads/images/<?php echo $images[$i][0]; ?>" data-lightbox="media-2" data-title="<?php echo ucwords($images[$i][1]); ?>"><img class="img-fluid example-image img-gallery" src="uploads/images/<?php echo $images[$i][0]; ?>" alt=""></a><span class="gallery-counter"><i class="fa fa-image"></i></span></div>
			            <h2 class=" title-small"><?php echo ucwords($images[$i][1]); ?></h2>
			            <div> </div>
		        	</div>
      			</div>
				<?php
			}
		?>
    <div class="row">
            <?php
			for($i=3; $i<7; $i++){
				?>
				<div class="col-md-3">
			        <div class="news-block">
			            <div class="news-media"><a class="example-image-link" href="uploads/images/<?php echo $images[$i][0]; ?>" data-lightbox="media-2" data-title="<?php echo ucwords($images[$i][1]); ?>"><img class="img-fluid example-image img-gallery" src="uploads/images/<?php echo $images[$i][0]; ?>" alt=""></a><span class="gallery-counter"><i class="fa fa-image"></i>12</span></div>
			            <h2 class=" title-small"><?php echo ucwords($images[$i][1]); ?></h2>
			            <div> </div>
		        	</div>
      			</div>
				<?php
			}
		?>
  </div>
      </section>