<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="seller/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>

<?php
       include 'seller/left.php';


    if(isset($_GET['ctrl'])){
        $ctrl = $_GET['ctrl'];

        switch ($ctrl) {
            case 'index':
                include 'seller/content.php';
                break;
            case 'product':
                include 'seller/product.php';
                if(isset($_GET['act'])){
                    $act = $_GET['act'];
                    include_once 'seller/insert_product.php';
                    switch ($act) {
                        case 'add':
                 
                            include_once 'seller/insert_product.php';
                            break;    
                        }
                                
                }
            break;
            case 'category':
                include 'seller/category.php';
                if(isset($_GET['act'])){
                    $act = $_GET['act'];

                    switch ($act) {
                        case 'view':
                            include_once 'seller/'.$act.'_category.php';
                            break;
                        case 'add':
                            include_once 'seller/'.$act.'_category.php';
                            break;                 
                        
                    }
                }
            break;
            case 'kind':
                include 'seller/kind.php';
                if(isset($_GET['act'])){
                    $act = $_GET['act'];

                    switch ($act) {
                        case 'view':
                            include_once 'seller/'.$act.'_kind.php';
                            break;
                        case 'add':
                            include_once 'seller/'.$act.'_kind.php';
                            break;                 
                        
                    }
                }
            break;
            case 'slide':
                include 'seller/slide.php';
                if(isset($_GET['act'])){
                    $act = $_GET['act'];

                    switch ($act) {
                        case 'view':
                            include_once 'seller/'.$act.'_slide.php';
                            break;
                        case 'add':
                            include_once 'seller/'.$act.'_slide.php';
                            break;                 
                        
                    }
                }
            break;
            case 'coupons':
                include 'seller/coupons.php';
                if(isset($_GET['act'])){
                    $act = $_GET['act'];

                    switch ($act) {
                        case 'view':
                            include_once 'seller/'.$act.'_coupons.php';
                            break;
                        case 'add':
                            include_once 'seller/'.$act.'_coupons.php';
                            break;                 
                        
                    }
                }
            break;
            case 'buyer':
                include 'seller/buyer.php';
            break;
            case 'order':
                include 'seller/order.php';
            break;
            case 'editcss':
                include 'seller/edit_css.php';
            break;
            case 'admin':
                include '../content.php';
            break;
            // case 'lgout':
            //     include '../content.php';
            // break;
   
            default:
           
                break;
        }
     
    }else  include 'seller/content.php';
    


    include 'seller/right.php';
?>


<!-- <script src="seller/js/main.js"></script> -->


<script src="seller/js/main.js"></script> 
