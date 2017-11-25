<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-10-05 15:35:52
 */

include 'admin/includes/config.php';
include 'admin/includes/db.php';
include 'admin/includes/functions.php';
?>
<nav class="navbar top-nav">
        <div class="container">
    <button class="navbar-toggler hidden-lg-up " type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation"> &#9776; </button>
    <div class="collapse navbar-toggleable-md" id="exCollapsingNavbar2"> <a class="navbar-brand" href="#">Responsive navbar</a>
            <ul class="nav navbar-nav ">
        <li class="nav-item active"> <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
        <?php
        	$categories = listAll('categories', 'WHERE status=0');

        	if($categories){
        		foreach ($categories as $key => $category) {
        			?>
        			<li class="nav-item"> <a class="nav-link" href="category.php?id=<?php echo $category['id']; ?>"><?php echo ucwords($category['title']); ?></a></li>
        			<?php
        		}
        	} else {
        		?>
        		<li class="nav-item"> <a class="nav-link" href="#">No any categories</a></li>
        		<?php
        	}
        ?>
      </ul>
    <form class="pull-xs-right">
        <div class="search">
                <input type="text" class="form-control" maxlength="64" placeholder="Search" />
                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
              </div>
    </form>
          </div>
  		</div>
</nav>