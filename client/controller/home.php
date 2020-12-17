<?php

    include 'client/model/categories.php';
    $index_ui_categories = index_ui_categories(15);
    
    if(isset($_GET['act']) && $_GET['act'] == 'home')
        include 'client/view/home/index.php';
    else
        include 'client/view/home/index.php';

?>