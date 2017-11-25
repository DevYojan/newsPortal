<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-09 11:30:36
 */

$international = viewTopNews(15,'international');
?>
<div class="container">
    <h3>
            <div class="heading-large">International News Section</div>
          </h3>
    <div class="row">
            <div class="col-md-4">
        <div class="card"> <img class="img-fluid" src="uploads/images/<?php echo $international[0]['images'][0]; ?>" alt="">
                <div class="card-block">
            <div class="news-title"><a href="details.php?id=<?php echo $international[0]['id']; ?>">
              <h2 class=" title-small"><?php echo ucfirst($international[0]['title']); ?></h2>
              </a></div>
            <p class="card-text"><small class="text-time"><em><?php echo $international[0]['date']; ?></em></small></p>
          </div>
              </div>
        <ul class="news-listing">
            <?php
              for($i=3; $i<7; $i++){
                ?>
                <li><a href="details.php?id=<?php echo $international[$i]['id']; ?>"><?php echo ucfirst($international[$i]['title']); ?></a></li>
                <?php
              }

            ?>      
        </ul>
      </div>
            <div class="col-md-4">
        <div class="card"> <img class="img-fluid" src="uploads/images/<?php echo $international[1]['images'][0]; ?>" alt="">
                <div class="card-block">
            <div class="news-title"><a href="details.php?id=<?php echo $international[1]['id']; ?>">
              <h2 class=" title-small"><?php echo ucfirst($international[1]['title']); ?></h2>
              </a></div>
            <p class="card-text"><small class="text-time"><em><?php echo $international[1]['date']; ?></em></small></p>
          </div>
              </div>
        <ul class="news-listing">
                <?php
              for($i=7; $i<11; $i++){
                ?>
                <li><a href="details.php?id=<?php echo $international[$i]['id']; ?>"><?php echo ucfirst($international[$i]['title']); ?></a></li>
                <?php
              }

            ?>  
              </ul>
      </div>
            <div class="col-md-4">
        <div class="card"> <img class="img-fluid" src="uploads/images/<?php echo $international[2]['images'][0]; ?>" alt="">
                <div class="card-block">
            <div class="news-title"><a href="details.php?id=<?php echo $international[2]['id']; ?>">
              <h2 class=" title-small"><?php echo ucfirst($international[2]['title']); ?></h2>
              </a></div>
            <p class="card-text"><small class="text-time"><em><?php echo $international[1]['date']; ?></em></small></p>
          </div>
              </div>
        <ul class="news-listing">
                <?php
              for($i=11; $i<15; $i++){
                ?>
                <li><a href="details.php?id=<?php echo $international[$i]['id']; ?>"><?php echo ucfirst($international[$i]['title']); ?></a></li>
                <?php
              }

            ?>  
              </ul>
      </div>
          </div>
  </div>