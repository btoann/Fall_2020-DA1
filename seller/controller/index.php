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
                    
                    if(isset($_GET['act'])){
                        $act = $_GET['act'];
                        switch ($act) {
                            case 'view':
                                include_once 'seller/product.php';
                                break;    
                            case 'add':
                                include_once 'seller/insert_product.php';
                                break;    
                            }                           
                    }
                    else  include_once 'seller/product.php';
                 
                break;

            case 'category':

               if(isset($_GET['act'])){
                        $act = $_GET['act'];
                        switch ($act) {
                            case 'view':
                                include_once 'seller/category.php';
                                break;    
                            case 'add':
                                include_once 'seller/insert_category.php';
                                break;    
                            }                           
                    }
                    else  include_once 'seller/category.php';
             
            break;

            case 'kind':

                if(isset($_GET['act'])){
                    $act = $_GET['act'];
                    switch ($act) {
                        case 'view':
                            include_once 'seller/kind.php';
                            break;    
                        case 'add':
                            include_once 'seller/insert_kind.php';
                            break;    
                        }                           
                }
                else  include_once 'seller/kind.php';
         
            break;

            case 'slide':
                
                if(isset($_GET['act'])){
                    $act = $_GET['act'];
                    switch ($act) {
                        case 'view':
                            include_once 'seller/slide.php';
                            break;    
                        case 'add':
                            include_once 'seller/insert_slide.php';
                            break;    
                        }                           
                }
                else  include_once 'seller/slide.php';
            break;
            
            case 'coupons':

                 if(isset($_GET['act'])){
                    $act = $_GET['act'];
                    switch ($act) {
                        case 'view':
                            include_once 'seller/coupons.php';
                            break;    
                        case 'add':
                            include_once 'seller/insert_coupon.php';
                            break;    
                        }                           
                }
                else  include_once 'seller/coupons.php';

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
            case 'lgout':
                include '../content.php';
                 break;
   
            default:
           
                break;
        }
     
    }else  include 'seller/content.php';
    


    include 'seller/right.php';
?>


<script src="seller/js/main.js"></script> 
