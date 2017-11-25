<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-16 00:42:20
 */

session_start();

if(isset($_SESSION['id']) && isset($_SESSION['full_name'])){

    $_SESSION['success'] = 'You are logged in '.$_SESSION['full_name'].'!';
    @header('location: dashboard.php');
    exit;
}  
require 'includes/header.php';
?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <?php include 'includes/notifications.php'; ?>
                	<form method="post" name="login" action="login-process.php">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" id="username" required />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" id="username" required />
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-primary" id="username" required />
						</div>
                	</form>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php require 'includes/footer.php'; ?>
