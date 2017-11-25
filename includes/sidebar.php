<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-08 11:41:22
 */

$topNews = viewTopNews(3);
?>
<aside class="col-lg-4 side-bar col-md-12">
        <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Latest</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Top</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Featured</a> </li>
              </ul>
        
        <!-- Tab panes -->
        <div class="tab-content sidebar-tabing">
                <div class="tab-pane active" id="home" role="tabpanel">
            <?php
              for($i=0; $i<3; $i++){
                ?>
                <div class="media"> <a class="media-left" href="details.php?id=<?php echo $topNews[$i]['id']; ?>"> <img class="media-object" src="<?php echo 'uploads/images/'.$topNews[$i]['images'][0]; ?>" alt=""> </a>
                    <div class="media-body">
                <div class="news-title">
                        <h2 class="title-small"><a href="details.php?id=<?php echo $topNews[$i]['id']; ?>"><?php echo ucfirst($topNews[$i]['title']); ?></a></h2>
                      </div>
                <div class="news-auther"><span class="time"><?php echo $topNews[$i]['date']; ?></span></div>
              </div>
                </div>
                <?php
              }
            ?>
            
          </div>
                <div class="tab-pane" id="profile" role="tabpanel">
                  <?php
                    $topNews = topNews();
                    
                    for($i=0; $i<3; $i++){
                      ?>
                      <div class="media"> <a class="media-left" href="details.php?id=<?php echo $topNews[$i]['id']; ?>"> <img class="media-object" src="uploads/images/<?php echo $topNews[$i]['image']; ?>" alt=""> </a>
                      <div class="media-body">
                      <div class="news-title">
                              <h2 class="title-small"><a href="details.php?id=<?php echo $topNews[$i]['id']; ?>"><?php echo ucfirst($topNews[$i]['title']); ?></a></h2>
                            </div>
                      <div class="news-auther"><span class="time"><?php echo $topNews[$i]['date']; ?></span></div>
                    </div>
                  </div>
                      <?php
                    }
                  ?>

                </div>
                <div class="tab-pane" id="messages" role="tabpanel">
            
                  <?php
                    $featured = featuredPosts(3);

                    for($i=0; $i<3; $i++){
                      ?>
                      <div class="media"> <a class="media-left" href="details.php?id=<?php echo $featured[$i]['id']; ?>"> <img class="media-object" src="uploads/images/<?php echo $featured[$i]['image'] ?>" alt=""> </a>
                    <div class="media-body">
                <div class="news-title">
                        <h2 class="title-small"><a href="details.php?id=<?php echo $featured[$i]['id']; ?>"><?php echo ucfirst($featured[$i]['title']); ?></a></h2>
                      </div>
                <div class="news-auther"><span class="time"><?php echo $featured[0]['date']; ?></span></div>
              </div>
                  </div>
                      <?php
                    }
                  ?>
            
                </div>
              </div>
        <div class="video-sec">
                <h4 class="heading-small">Featured Video</h4>
                <div class="video-block">
            <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
                  </div>
          </div>
              </div>
      </aside>