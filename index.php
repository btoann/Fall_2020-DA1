<?php
    ob_start();
    session_start();

    include_once '.system/lib/controller.php';
    // Khởi động event trên Database
    event_scheduler('on');

    if(!(isset($_GET['ctrl']) && $_GET['ctrl'] == 'account'))
    {
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>sidebyside.shop</title>
        <script src=".public/js/jquery_3.5.1.js" defer></script>
        <script async src=".public/js/sweetalert.min.js"></script>
    </head>
    <body>
    
        <h3>Trang chủ</h3>
        
        <?php
            if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
            {
                if($_SESSION['sbs_user']['role'] >= 30) 
                    echo
                        '<a href="admin.php">[ admin: '.$_SESSION['sbs_user']['name'].' ]</a>
                        &ensp;
                        <a href="seller.php">[ Trang người bán ]</a>
                        &ensp;
                        <a href="index.php?ctrl=account&act=signout">[ Đăng xuất ]</a>';
                else
                {
                    $api = ($_SESSION['sbs_user']['role'] >= 25 && $_SESSION['sbs_user']['role'] < 30)
                            ? 'google: '
                            : (($_SESSION['sbs_user']['role'] >= 20 && $_SESSION['sbs_user']['role'] < 25)? 'facebook: ' : '');
                    echo
                        '<a href="index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id'].'">[ '.$api.$_SESSION['sbs_user']['name'].' ]</a>
                        &ensp;
                        <a href="seller.php">[ Trang người bán ]</a>
                        &ensp;
                        <a href="index.php?ctrl=account&act=signout">[ Đăng xuất ]</a>';
                }
            }
            else
            {
                echo
                    '<a href="index.php?ctrl=account&act=signin">[ Đăng nhập ]</a>
                    &ensp;
                    <a href="seller.php">[ Trang người bán ]</a>';
            }
        ?>

        <?php

            $index_file = 'client/controller/home.php';
            if(isset($_GET['ctrl']) && $_GET['ctrl'])
            {
                $filename = 'client/controller/'.$_GET['ctrl'].'.php';
                include (file_exists($filename)) ? $filename : $index_file;
            }
            else
                include $index_file;

        ?>

    </body>
</html>


<?php
    }
    else
    {
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>sidebyside.shop</title>
        <link rel="stylesheet" href=".public/css/client/account.css">
        <link rel="stylesheet" href=".public/css/_style.css">
        <script src=".public/js/jquery_3.5.1.js"></script>
        <script src=".public/js/sweetalert.min.js"></script>
        <script async src=".public/js/client/account.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
    </head>
    <body class="lightgray-bg-i">

        <?php
                if(isset($_GET['act']) && ($_GET['act'] == 'signin' || $_GET['act'] == 'signup' || $_GET['act'] == 'signout' || $_GET['act'] == 'forgot'))
                {
                    $index_file = 'index';
                    $filename = 'client/controller/'.$_GET['ctrl'].'.php';
                    include (file_exists($filename)) ? $filename : $index_file;
                }
                else
                    header('location: index.php?ctrl=account&act=signin');
            }
            ob_end_flush();
        ?>

    </body>
</html>