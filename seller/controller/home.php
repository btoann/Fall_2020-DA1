<?php

    include 'seller/model/products.php';
    $count_products = count_products($_SESSION['sbs_id']);
    
    if(isset($_GET['act']) && $_GET['act'] == 'home')
        include 'seller/view/home/index.php';
    else
        include 'seller/view/home/index.php';

?>