<?php

    include 'client/model/categories.php';
    $category = getall_category();
    
    if(isset($_GET['act']) && $_GET['act'] == 'home')
        include 'client/view/home/index.php';
    else
        include 'client/view/home/index.php';

?>