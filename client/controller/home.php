<?php

    include 'client/model/categories.php';
    $categories_0 = get_categories_0();
    
    if(isset($_GET['act']) && $_GET['act'] == 'home')
        include 'client/view/home/index.php';
    else
        include 'client/view/home/index.php';

?>