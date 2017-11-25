<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-08 10:41:37
 */

$sliderContents = viewTopNews(7);
?>
<div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                    <div class="news-block">
                <div class="news-media"><img class="img-fluid" src="<?php echo 'uploads/images/'.$sliderContents[4]['images'][0]; ?>" alt=""></div>
                <div class="news-title">
                        <h2 class=" title-large"><a href="details.php?id=<?php echo $sliderContents[4]['id']; ?>"><?php echo ucfirst($sliderContents[4]['title']); ?></a></h2>
                      </div>
                <div class="news-des"><?php echo ucfirst(implode(' ', array_slice(explode(' ', $sliderContents[4]['description']), 0, 15))).' .....'; ?></div>
                <div class="time-text"><strong><?php echo $sliderContents[4]['date']; ?></strong></div>
                <div></div>
              </div>
            </div>
            <div class="carousel-item">
                <div class="news-block">
                <div class="news-media"><img class="img-fluid" src="<?php echo 'uploads/images/'.$sliderContents[5]['images'][0]; ?>" alt=""></div>
                <div class="news-title">
                        <h2 class=" title-large"><a href="details.php?id=<?php echo $sliderContents[5]['id']; ?>"><?php echo ucfirst($sliderContents[5]['title']); ?></a></h2>
                      </div>
                <div class="news-des"><?php echo ucfirst(implode(' ', array_slice(explode(' ', $sliderContents[5]['description']), 0, 15))).' .....'; ?></div>
                <div class="time-text"><strong><?php echo $sliderContents[5]['date']; ?></strong></div>
                <div></div>
              </div>    
             </div>
             <div class="carousel-item">
                <div class="news-block">
                <div class="news-media"><img class="img-fluid" src="<?php echo 'uploads/images/'.$sliderContents[6]['images'][0]; ?>" alt=""></div>
                <div class="news-title">
                        <h2 class=" title-large"><a href="details.php?id=<?php echo $sliderContents[6]['id']; ?>"><?php echo ucfirst($sliderContents[6]['title']); ?></a></h2>
                      </div>
                <div class="news-des"><?php echo ucfirst(implode(' ', array_slice(explode(' ', $sliderContents[6]['description']), 0, 15))).' .....'; ?></div>
                <div class="time-text"><strong><?php echo $sliderContents[6]['date']; ?></strong></div>
                <div></div>
              </div>    
             </div>
            
        </div>