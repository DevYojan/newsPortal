<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-19 17:50:17
 */

session_start();

include 'includes/session.php';
include 'includes/header.php';
include 'includes/navbar.php';

?>

<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <?php include 'includes/notifications.php'; ?>
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Category List
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-wrench"></i> Category Management
                            </li>
                            <li class="active">
                                <i class="fa fa-list-ol"></i> Category List
                            </li>
                        </ol>
                    </div>

                    <table class="table table-bordered table-striped">
                    	<thead>
                    		<th>S.N</th>
                    		<th>Category Title</th>
                    		<th>Category Status</th>
                    		<th>Added Date</th>
                    		<th>Actions</th>
                    	</thead>
                    	<tbody>
                    		<?php
                    			$categories = listAll('categories');

                    			if($categories){
                    				foreach($categories as $key => $cat_info){
                    					?>
                    					<tr>
                    						<td><?php echo $key+1; ?></td>
                    						<td><?php echo ucwords($cat_info['title']); ?></td>
                    						<td><?php echo ucwords(($cat_info['status'] == 0?'active':'inactive')); ?>
                    						</td>
                    						<td><?php echo date('Y-m-d', strtotime($cat_info['added_date'])); ?>
                    							
                    						</td>
                    						<td>
                    							<a href="category-add.php?id=<?php echo $cat_info['id']; ?>" class="btn btn-success" style="border-radius: 50%">
                    								<i class="fa fa-pencil"></i>
                    							</a>
                    							<a href="category.php?id=<?php echo $cat_info['id']; ?>" class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Are you sure you want to delete this category?')">
                    								<i class="fa fa-trash"></i>
                    							</a>
                    						</td>
                    					</tr>
                    					<?php
                    				}
                    			} else {
                    				?>
                    					<td colspan="5" class="text-danger">No any category in the database.</td>
                    				<?php
                    			}
                    		?>
                    	</tbody>
                    </table>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/footer.php'; ?>