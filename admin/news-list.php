<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-28 17:10:48
 */

include 'includes/session.php';

require 'includes/header.php'; 
require 'includes/navbar.php';

?>
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
                                <i class="fa fa-list-ol"></i> News List
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <table class="table table-bordered table-striped">
                	<thead>
                		<th>S.N.</th>
                		<th>Date</th>
                		<th>Title</th>	
                		<th>Description</th>	
                		<th>Category</th>	
                		<th>Status</th>	
                		<th>Reporter</th>	
                		<th>Added By</th>	
                		<th>Images</th>	
                		<th>Actions</th>	
                	</thead>
                	<tbody>
                		<?php
                			$allNews = newsList('ORDER BY id DESC');

                            if($allNews){

            					foreach($allNews as $key => $value){
            						$sql1 = "SELECT * FROM news_images WHERE news_id=".$value['id'];
            						$query = mysqli_query($conn, $sql1);

            						$images = mysqli_num_rows($query);
            						?>
            						<tr>
            							<td><?php echo ($key+1).'.'; ?></td>
            							<td><?php echo (date('Y-m-d', strtotime($value['added_date']))); ?></td>
            							<td><?php echo ucfirst($value['title']); ?></td>
            							<td><?php echo $value['description']; ?></td>
            							<td><?php echo ucwords(($value['category'] == '')?'Default Category':$value['category']); ?></td>
            							<td><?php echo ($value['status'] == 0)?'Active':'Inactive'; ?></td>
            							<td><?php echo ($value['reporter'] == '')?'News Reporter':$value['reporter']; ?></td>
            							<td><?php echo ($value['added_by']); ?></td>
            							<td><?php echo $images; ?></td>
            							<td>
            								<a href="news-add.php?id=<?php echo $value['id']; ?>" class="btn btn-success" style="border-radius: 50%">
            									<i class="fa fa-pencil"></i>
            								</a>
            								<a href="news.php?id=<?php echo $value['id']; ?>" class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Are you sure you want to delete this news?');">
            									<i class="fa fa-trash"></i>
            								</a>
            							</td>
            						</tr>
            						<?php
            					}
                					
                				} else {
                					?>
                					<tr>
                						<td colspan="10">No any news in database.</td>
                					</tr>
                					<?php
                				}
                		?>
                	</tbody>
                </table>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php require 'includes/footer.php' ?>