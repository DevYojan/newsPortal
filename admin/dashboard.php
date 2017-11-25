<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-16 00:42:20
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
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php require 'includes/footer.php' ?>