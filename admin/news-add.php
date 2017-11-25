<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-28 14:25:23
 */

include 'includes/session.php';

require 'includes/header.php'; 
require 'includes/navbar.php';

if(isset($_GET['id']) && $_GET['id'] != ''){
	$id = sanitize($_GET['id']);
	$check = isAvailable('news', 'id', $id);

	if($check){
		$act = 'update';
	} else {
        $act = 'add';
    }
} else {
    $act = 'add';
}

?>
<style type="text/css">
	.images{
		float: left;
	}

	.img{
		max-height: 150px;
		margin-right: 10px;
	}
</style>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <?php include 'includes/notifications.php'; ?>
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            News
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-newspaper-o"></i> News Management
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> News <?php echo ucfirst($act); ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <form action="news.php" method="post" enctype="multipart/form-data" class="form form-horizontal">
                	<div class="form-group">
                		<label class="col-sm-3">News Date: </label>
                		<div class="col-sm-8">
                			<input type="date" name="news_date" class="form-control" value="<?php echo ($act=='update')?date('Y-m-d', strtotime($check['news_date'])):'';  ?>" />
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">News Location: </label>
                		<div class="col-sm-8">
                			<input type="text" name="news_location" class="form-control" value="<?php echo ($act=='update')?ucwords($check['location']):'';  ?>" />
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">News Title: </label>
                		<div class="col-sm-8">
                			<input type="text" name="news_title" class="form-control" value="<?php echo ($act=='update')?ucfirst($check['title']):'';  ?>" />
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">News Summary: </label>
                		<div class="col-sm-8">
                			<textarea name="news_summary" class="form-control" cols="30" rows="10"  ><?php echo ($act=='update')?ucfirst($check['summary']):'';  ?></textarea>
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">News Description: </label>
                		<div class="col-sm-8">
                			<textarea class="form-control" name="news_description" cols="30" rows="10"><?php echo ($act=='update')?ucfirst($check['description']):'';  ?></textarea>
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">News Category: </label>
                		<div class="col-sm-8">
                			<select name="news_category" class="form-control">
                				<?php 
                					$categories = listAll('categories', 'WHERE status = 0 ORDER BY id DESC');
                					if($categories){
                						foreach ($categories as $key => $category) {
                							?>
                							<option value="<?php echo $category['id']; ?>" <?php echo ($act=='update' && $check['category_id'] == $category['id'])?'selected':''; ?> >
                								<?php echo ucwords($category['title']); ?>
                							</option>
                							<?php
                						}
                					}
                				?>
                				<option value="0" <?php echo ($act=='update' && $check['category_id'] == 0)?'selected':''; ?> >Default Category</option>
                			</select>
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">News Status: </label>
                		<div class="col-sm-8">
                			<select name="news_status" class="form-control">
                				<option value="0" <?php echo ($act=='update' && $check['STATUS'] == 0)?'selected':''; ?> >Active</option>
                				<option value="1" <?php echo ($act=='update' && $check['STATUS'] == 1)?'selected':''; ?> >Inactive</option>
                			</select>
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">News Reporter: </label>
                		<div class="col-sm-8">
                			<select name="news_reporter" class="form-control">
								<?php
									$reporters = listAll('users', 'WHERE roll_id=1 AND status=0 ORDER BY id DESC');
									foreach ($reporters as $key => $reporter) {
										?>
										<option value="<?php echo $reporter['id']; ?>" <?php echo ($act=='update' && $check['reporter_id'] == $reporter['id'])?'selected':''; ?> ><?php echo ucwords($reporter['full_name']); ?></option>
										<?php
									}
								?>
								<option value="0" <?php echo ($act=='update' && $check['reporter_id'] == 0)?'selected':''; ?> >News Reporter</option>                				
                			</select>
                		</div>
                	</div>
                    <div class="form-group">
                        <label class="col-sm-3">Featured: </label>
                        <div class="col-sm-8">
                        <input type="checkbox" name="featured" /> Tick if this news is featured
                        </div>
                    </div>
                	<div class="form-group">
                		<label class="col-sm-3">News Images: </label>
                		<div class="col-sm-8">
                			<?php
	                			if($act=='update'){
	                				$order = "WHERE news_id=".$check['id'];
	                				$images = listAll('news_images', 'WHERE news_id='.$check['id']);

	                				if($images){
	                					foreach ($images as $key => $image) {
	                						?>
	                						<div class="images">
	                							<img src="../uploads/images/<?php echo $image['image_name']; ?>" class="img img-responsive thumbnail">
	                							<input type="checkbox" name="delete[]" value="<?php echo $image['image_name']; ?>">
	                						</div>
	                						<?php
	                					}
	                					?>
	                					<p class="alert-info col-sm-12">Check the images you want to delete and if you want to add new images, please select from below.</p>
	                					<?php
	                				} else {
	                					?>
	                					<p class="alert-warning">No any images related to this news.</p>
	                					<?php
	                				}
	                			}
                			?>
                			<input type="file" name="news_images[]" multiple="multiple" accept="image/*" class="col-sm-12">
                		</div>
                	</div>
                	<input type="hidden" name="id" value="<?php echo ($act=='update')?$id:''; ?>">
                	<button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> <?php echo ucfirst($act); ?> News</button>
                </form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php require 'includes/footer.php' ?>