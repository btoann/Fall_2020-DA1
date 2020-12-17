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
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href=".public/css/client/css-fix/style.css" />
    <!-- <link rel="stylesheet" href=".public/bootstrap/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href=".public/bootstrap/js/bootstrap.min.js" />
    <link rel="stylesheet" href=".public/icons/css/fontello.css" />
    <script src="https://kit.fontawesome.com/978d2e326d.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <a href="./index-fix.html"><img src=".public/images/logo.png" alt="" /></a>
            </div>
            <div class="menu">
                <div class="menu-top">
                    <div class="menu-top-list">
                        <ul>
                            <li><a href="seller.php" class="a">Bán hàng cùng SBS</a></li>
                            <li><a href="#" class="a">Chăm sóc khách hàng</a></li>
                            <li><a href="#" class="a">Kiểm tra đơn hàng</a></li>
                            <li><a href="#" class="a">Chế độ tối</a></li>
                            <li><a href="#" class="a">Thay đổi ngôn ngữ</a></li>
                        </ul>
                    </div>
                    <div class="menu-top-login">
                        <p>
                        <?php
                            if(isset($_SESSION['sbs_user'])) print_r($_SESSION['sbs_user']);
                            if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
                            {
                                if($_SESSION['sbs_user']['role'] >= 30) 
                                    echo
                                        '<a href="index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id'].'">'.$_SESSION['sbs_user']['name'].'</i></a>
                                        &ensp;
                                        <a href="admin.php"><i class="con-user-circle-o"></i></a>
                                        &ensp;
                                        <a href="index.php?ctrl=account&act=signout"><i class="icon-logout-2"></i></a>';
                                else
                                {
                                    $api = ($_SESSION['sbs_user']['role'] >= 25 && $_SESSION['sbs_user']['role'] < 30)
                                            ? 'google: '
                                            : (($_SESSION['sbs_user']['role'] >= 20 && $_SESSION['sbs_user']['role'] < 25)? 'facebook: ' : '');
                                    echo
                                        '<a href="index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id'].'">'.$_SESSION['sbs_user']['name'].'</i></a>
                                        &ensp;
                                        <a href="index.php?ctrl=account&act=signout"><i class="icon-logout-2"></i></a>';
                                }
                            }
                            else
                            {
                                echo
                                    '<a href="index.php?ctrl=account&act=signin">Đăng Nhập <i class="icon-user-2"></i></a>';
                            }
                        ?>
                            
                        </p>
                    </div>
                </div>
                <div class="menu-bottom">
                    <div class="menu-bottom-category">
                        <p>
                            <a href="#" class="a1"><i class="icon-list-nested"></i> Danh mục</a>
                        </p>
                        <div class="hover">
                            <div class="category">
                                <div class="category-hover">
                                    <ul class="block-1">
                                        <?php
                                          foreach($index_ui_categories as $index_category)
                                          {
                                              echo
                                                '<li>
                                                    <strong><a href="index.php?ctrl=categories&id='.$index_category['id'].'">'.$index_category['name'].'</a></strong>
                                                    <span>
                                                        <i class="fas fa-angle-right" style="font-size: 18px"></i>
                                                    </span>
                                                </li>';
                                          }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="menu-bottom-search">
                        <div class="menu-bottom-search-in">
                            <input type="text" placeholder="Tìm kiếm sản phẩm, danh mục, đại lý..." /><a href="#"><i
                                    class="fas fa-search"></i></a>
                            <hr/>
                            </div>
                    </div>
                    <div class="menu-bottom-cart">
                        <a href="#"><i class="fas fa-shopping-cart"></i><span class="shopping-number">0</span></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
                if(isset($_GET['act']) && ($_GET['act'] == 'signin' || $_GET['act'] == 'signup' || $_GET['act'] == 'signout' || $_GET['act'] == 'forgot' || $_GET['act'] == 'user'))
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