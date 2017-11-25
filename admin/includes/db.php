<?php

/**
 * @Author: Yojan Regmi
 * @Date:   2017-09-16 15:33:12
 */


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

mysqli_select_db($conn, DB_NAME);