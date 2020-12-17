<?php

    if(!isset($_SESSION['sbs_id_seller']))
    {
        header('location: seller.php?ctrl=account&act=signin');
    }
    else
    {
        include 'seller/model/products.php';
        $count_products = count_products($_SESSION['sbs_id_seller']);

        if(isset($_GET['act']) && $_GET['act'] == 'home')
            include 'seller/view/home/head.php';
        else
            include 'seller/view/home/index.php';
    }

?>