<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-17 21:52:25
 */

session_start();

include 'includes/session.php';
include 'includes/header.php';
include 'includes/navbar.php';

if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = sanitize($_GET['id']);
    $category = isAvailable('categories', 'id', $id);

    if(!$category){
        $_SESSION['warning'] = 'Category does not exists.';
        @header('location: category-add.php');
        exit;
    } else {
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
                            Category <?php echo (isset($act)) ? ucwords($act.'e') : ''; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-list"></i> Category Management
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> Category <?php echo (isset($act)) ? ucwords($act.'e') : ''; ?>
                            </li>
                        </ol>
                    </div>

                    <form action="category.php" method="post" class="form form-horizontal">
                    	<div class="form-group">
                    		<label class="col-sm-3">Category Name: </label>
                    		<div class="col-sm-6">
                    			<input type="text" name="category_name" class="form-control" value="<?php echo (isset($act)) ? ucwords($category['title']) : ''; ?>" placeholder="Enter name of category here." required="required" />
                    		</div>
                    	</div>

                    	<div class="form-group">
                    		<label class="col-sm-3">Category Status: </label>
                    		<div class="col-sm-6">
                    			<select name="category_status" class="form-control" required="required">
                    				<option value="0" <?php echo (isset($act) && $category['status'] == 0) ? 'selected' : ''; ?> >Active</option>
                    				<option value="1" <?php echo (isset($act) && $category['status'] == 1) ? 'selected' : ''; ?> >Inactive</option>
                    			</select>
                    		</div>
                    	</div>

                        <input type="hidden" name="id" value="<?php echo (isset($act))?$category['id']:'';?>">

                    	<button type="submit" class="btn btn-primary">
                    		<i class="fa fa-fw fa-plus"></i>
                    		<?php echo (isset($act)) ? 'Update' : 'Submit'; ?>
                    	</button>
                    </form>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/footer.php'; ?>