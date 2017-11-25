<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-25 11:04:40
 */
include 'includes/session.php';
require 'includes/header.php'; 

$id = $_SESSION['id'];
$user = isAvailable('users', 'id', $id);

if($user){
    if($user['roll_id'] == 1){
        $_SESSION['error'] = 'Unauthorized access';
        @header('location: dashboard.php');
        exit;
    }
}

require 'includes/navbar.php';

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <?php include 'includes/notifications.php'; ?>
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            User List
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-group"></i> User Mangement
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> User List
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <table class="table table-bordered table-striped">
                	<thead>
                		<th>S.N</th>
                		<th>Full Name</th>
                		<th>Address</th>
                		<th>Username</th>
                		<th>Role</th>
                		<th>Status</th>
                		<th>Added Date</th>
                		<th>Actions</th>
                	</thead>
                	<tbody>
                		<?php
                			$listUsers = listAll('users', 'ORDER BY id DESC');

                			if($listUsers){
                				foreach($listUsers as $key => $user){
                					?>
                					<tr>
                						<td><?php echo $key+1; ?></td>
                						<td><?php echo ucwords($user['full_name']); ?></td>
                						<td><?php echo ucwords($user['address']); ?></td>
                						<td><?php echo $user['username']; ?></td>
                						<td><?php echo ($user['roll_id'] == 0)?'Admin':'Reporter'; ?></td>
                						<td><?php echo ($user['status'] == 0)?'Active':'Inactive'; ?></td>
                						<td><?php echo date('Y-m-d', strtotime($user['added_date'])); ?></td>
                						<td>
                							<a href="user-add.php?id=<?php echo $user['id']; ?>" class="btn btn-success" style="border-radius: 50%">
                								<i class="fa fa-pencil"></i>
                							</a>
                							<a href="user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" style="border-radius: 50%" onclick="return confirm('Are you sure you want to delete this user?')">
                								<i class="fa fa-trash"></i>
                							</a>
                						</td>
                					</tr>
                					<?php
                				}
                			} else {
                				?>
                				<tr>
                				<td colspan="8" class="alert-danger">No any Users in database.</td>
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