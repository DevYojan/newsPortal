<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-05 15:25:54
 */

require 'includes/header.php';
require 'includes/navbar.php';
?>

<section class="banner-sec">
        <div class="container">
    <?php require 'includes/topNews.php'; ?>
            <div class="col-md-6 top-slider">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
                <!-- Indicators -->
                <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>
                
                <!-- Wrapper for slides -->
        <?php include 'includes/topSlider.php'; ?>
              </div>
      </div>
          </div>
  </div>
      </section>
<section class="section-01">
        <div class="container">
    <div class="row">
        <?php include 'includes/politics.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
          </div>
  </div>
      </section>
<section class="section-02">
  <?php include 'includes/international.php'; ?>
</section>
<?php include 'includes/imageGallery.php'; ?>
<div class="sub-footer">
  <div class="container">
    <h3>
            <div class="heading-large">Top Five Stories</div>
          </h3>
    <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
    <?php
      $topNews = topNews(5);
    ?>         
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
        <div class="carousel-item active"> <img class="img-fluid" src="uploads/images/<?php echo $topNews[0]['image']; ?>">
                <div class="carousel-caption">
            <div class="news-title">
                    <h2 class=" title-large"><a href="details.php?id=<?php echo $topNews[0]['id']; ?>"><?php echo ucfirst($topNews[0]['title']); ?></a></h2>
                  </div>
          </div>
        </div>

        <?php
          for($i=1; $i<5; $i++){
            ?>
            <div class="carousel-item"> <img class="img-fluid" src="uploads/images/<?php echo $topNews[$i]['image']; ?>">
                <div class="carousel-caption">
            <div class="news-title">
                    <h2 class=" title-large"><a href="details.php?id=<?php echo $topNews[$i]['id']; ?>"><?php echo ucfirst($topNews[$i]['title']); ?></a></h2>
                  </div>
          </div>
        </div>
            <?php
          }
        ?>
        <!-- End Item -->
        
      </div>
            <!-- End Carousel Inner -->
            
    <ul class="list-group col-sm-4">
        <li data-target="#myCarousel" data-slide-to="0" class="list-group-item active">
          <h4><?php echo ucfirst($topNews[0]['title']); ?></h4>
        </li>
        <?php
          for($i=1; $i<5; $i++){
            ?>
              <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="list-group-item">
                <h4><?php echo ucfirst($topNews[$i]['title']); ?></h4>
              </li>
            <?php
          }
        ?>
    </ul>
            
            <!-- Controls -->
            <div class="carousel-controls"> <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a> </div>
          </div>
    <!-- End Carousel --> 
  </div>
</div>
<?php
  require 'includes/footerNav.php';
  require 'includes/footer.php';
?>