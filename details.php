<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-11 21:37:54
 */

include 'admin/includes/config.php';
include 'admin/includes/db.php';
include 'admin/includes/functions.php';
include 'includes/header.php';

if(isset($_GET['id']) && $_GET['id'] != ''){
	$details = viewNews($_GET['id']);

	if(!$details){
		@header('location: index.php');
		exit;
	}

	$topNews = viewTopNews();
} else {
	@header('location: index.php');
	exit;
}

?>

<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
	<div class="row">
		<div class="left_bar">
		  <div class="single_leftbar">
		    <h2><span>Recent Posts</span></h2>
		    <div class="singleleft_inner">
		      <ul class="recentpost_nav wow fadeInDown">
		        <?php
		        for($i=0; $i<3; $i++){
		        	?>
		        	<li><a href="details.php?id=<?php echo $topNews[$i]['id']; ?>"><img src="uploads/images/<?php echo $topNews[$i]['images'][0]; ?>" alt=""></a> <a class="recent_title" href="details.php?id=<?php echo $topNews[$i]['id']; ?>"> <?php echo ucwords($topNews[$i]['title']); ?></a></li>
		        	<?php
		        }
		        ?>
		      </ul>
		    </div>
		  </div>
		</div>
	</div>
</div>
<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
          <div class="row">
            <div class="middle_bar">
              <div class="single_post_area">
                <ol class="breadcrumb">
                  <li><a href="index.php"><i class="fa fa-home"></i>News<i class="fa fa-angle-right"></i></a></li>
                  <li><a href="category.php?id=<?php echo $details['cat_id']; ?>"><?php echo ucfirst($details['category']); ?><i class="fa fa-angle-right"></i></a></li>
                </ol>
                <h2 class="post_title wow "><?php echo ucwords($details['title']); ?></h2>
                <i class="fa fa-user"></i> <?php echo ucwords($details['reporter']); ?>   <i class="fa fa-clock-o"></i>   <?php echo $details['date']; ?>
                <div class="single_post_content">
                  <?php
                  for($i=0; $i<count($details['images']); $i++){
                  	?>
                  	<img class="img-center" src="uploads/images/<?php echo $details['images'][$i]; ?>" alt="">
                  	<?php
                  }
                  ?>
                  <p><?php echo ucfirst($details['description']); ?></p>
                  </div>
                <div class="social_area wow fadeInLeft">
                  <ul>
                    <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                    <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                    <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                    <li><a href="#"><span class="fa fa-pinterest"></span></a></li>
                  </ul>
                </div>
                <div class="related_post">
                  <h2 class="wow fadeInLeftBig">Related Posts you may like <i class="fa fa-thumbs-o-up"></i></h2>
                  <ul class="recentpost_nav relatedpost_nav wow fadeInDown animated">
                    <li><a href="#"><img alt="" src="../images/150x80.jpg"></a> <a href="#" class="recent_title"> Curabitur ac dictum nisl eu hendrerit ante</a></li>
                    <li><a href="#"><img alt="" src="../images/150x80.jpg"></a> <a href="#" class="recent_title"> Curabitur ac dictum nisl eu hendrerit ante</a></li>
                    <li><a href="#"><img alt="" src="../images/150x80.jpg"></a> <a href="#" class="recent_title"> Curabitur ac dictum nisl eu hendrerit ante</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="row">
            <div class="right_bar">
              <div class="single_leftbar wow fadeInDown">
                <h2><span>Popular Post</span></h2>
                <div class="singleleft_inner">
                  <ul class="catg3_snav ppost_nav wow fadeInDown">
                    	<?php
                        $popularNews = topNews(5);

                        for($i=0; $i<5; $i++){
                          ?>
                          <li>
                            <div class="media"> <a href="details.php?id=<?php echo $popularNews[$i]['id']; ?>" class="media-left"> <img alt="" src="uploads/images/<?php echo $popularNews[$i]['image']; ?>"> </a>
                              <div class="media-body"> <a href="details.php?id=<?php echo $popularNews[$i]['id']; ?>" class="catg_title"> <?php echo ucfirst($popularNews[$i]['title']); ?></a></div>
                              </div>
                          </li>
                          <?php
                        }
                      ?>
                  </ul>
                </div>
              </div>
          </div>
      </div>
  </div>

<?php include 'includes/footer.php'; ?>
<?php
	$count = increaseHits($_GET['id']);
?>