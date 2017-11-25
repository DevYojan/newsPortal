<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-08 11:16:55
 */

$politics = viewTopNews(500, 'politics');
?>

<div class="col-lg-8 col-md-12">
          <h3 class="heading-large">Politics</h3>
          <div class="row">
          	<?php
          		for($i=0; $i<4; $i++){
          			?>
          				<div class="col-lg-6">
				            <div class="card"> <img class="img-fluid" src="uploads/images/<?php echo $politics[$i]['images'][0]; ?>" alt="">
				                    <div class="card-block">
				                <div class="news-title"><a href="details.php?id=<?php echo $politics[$i]['id']; ?>">
				                  <h2 class=" title-small"><?php echo ucfirst($politics[$i]['title']); ?></h2>
				                  </a></div>
				                <p class="card-text"><?php echo ucfirst(implode(' ', array_slice(explode(' ', $politics[$i]['description']), 0, 10))); ?></p>
				                <p class="card-text"><small class="text-time"><em><?php echo $politics[$i]['date']; ?></em></small></p>
				              </div>
				                  </div>
				          </div>
          			<?php
          		}
          	?>
              
                
              </div>
      </div>