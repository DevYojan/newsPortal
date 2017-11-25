<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-16 00:55:17
 */
?>
<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">News Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['full_name']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#categories"><i class="fa fa-fw fa-list"></i> Category Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="categories" class="collapse">
                            <li>
                                <a href="category-add.php">Category Add</a>
                            </li>
                            <li>
                                <a href="category-list.php">Category List</a>
                            </li>
                        </ul>
                    </li>

                    <?php 
                        $id = $_SESSION['id'];
                        
                        $check = isAvailable('users', 'id', $id);

                        if($check){
                            if($check['roll_id'] == 0){
                                ?>
                                    <li>
                                        <a href="javascript:;" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-group"></i> User Management <i class="fa fa-fw fa-caret-down"></i></a>
                                        <ul id="user" class="collapse">
                                            <li>
                                                <a href="user-add.php">User Add</a>
                                            </li>
                                            <li>
                                                <a href="user-list.php">User List</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php
                            }
                        }

                    ?>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#news"><i class="fa fa-fw fa-newspaper-o"></i> News Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="news" class="collapse">
                            <li>
                                <a href="news-add.php">News Add</a>
                            </li>
                            <li>
                                <a href="news-list.php">News List</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ads"><i class="fa fa-fw fa-dollar"></i> Ads Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="ads" class="collapse">
                            <li>
                                <a href="ads-add.php">Ads Add</a>
                            </li>
                            <li>
                                <a href="ads-list.php">Ads List</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        