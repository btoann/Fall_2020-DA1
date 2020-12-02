<?php

    include 'admin/model/categories.php';
    
    if(isset($_GET['act']) && $_GET['act'] == 'home')
        include 'admin/view/home/index.php';
    else
        include 'admin/view/home/index.php';

?>