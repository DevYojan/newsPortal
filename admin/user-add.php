<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-23 12:30:36
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

if(isset($_GET['id']) && $_GET['id'] != ''){
	$id = sanitize($_GET['id']);
	$user = isAvailable('users', 'id', $id);

	if($user){
		$act = 'updat';
	}
}

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <?php include 'includes/notifications.php'; ?>
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            User <?php echo (isset($act))?'Update':'Add'; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-user"></i> User Management
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> User <?php echo (isset($act))?'Update':'Add'; ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <form action="user.php" method="post" class="form form-horizontal">
                	<div class="form-group">
                		<label class="col-sm-3">Full Name: </label>
                		<div class="col-sm-8">
                			<input type="text" name="full_name" class="form-control" value="<?php echo (isset($act))?$user['full_name']:''; ?>" />
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">Address: </label>
                		<div class="col-sm-8">
                			<input type="text" name="address" class="form-control" value="<?php echo (isset($act))?$user['address']:''; ?>" />
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">Username: </label>
                		<div class="col-sm-8">
                			<input type="text" name="username" class="form-control" value="<?php echo (isset($act))?$user['username']:''; ?>" />
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">Password: </label>
                		<div class="col-sm-8">
                			<input type="password" name="password" class="form-control" />
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">Role: </label>
                		<div name="role" class="col-sm-8">
                			<select name="role" class="form-control">
                				<option value="0" <?php echo (isset($user) && $user['roll_id'] == 0)?'selected':''; ?> >Admin</option>
                				<option value="1" <?php echo (isset($user) && $user['roll_id'] == 1)?'selected':''; ?> >Reporter</option>
                			</select>
                		</div>
                	</div>
                	<div class="form-group">
                		<label class="col-sm-3">Status: </label>
                		<div name="status" class="col-sm-8">
                			<select name="status" class="form-control">
                				<option value="0" <?php echo (isset($user) && $user['status'] == 0)?'selected':''; ?> >Active</option>
                				<option value="1" <?php echo (isset($user) && $user['status'] == 1)?'selected':''; ?> >Inactive</option>
                			</select>
                		</div>
                	</div>
                	<input type="hidden" name="id" value="<?php echo (isset($user['id']))?$user['id']:''; ?>">
                	<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                </form>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php require 'includes/footer.php' ?>