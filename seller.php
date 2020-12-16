<?php
    ob_start();
    session_start();

    include_once '.system/lib/controller.php';
    // Khởi động event trên Database
    event_scheduler('on');

    if(isset($_SESSION['sbs_id_seller']) && $_SESSION['sbs_id_seller'] > 0)
    {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller's SBS.shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href=".public/css/seller/home.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script asyn src=".public/js/jquery_3.5.1.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="dashboard">
                <div id="dark" class="left">
                    <span class="left__icon">
                        <span></span>
                    <span></span>
                    <span></span>
                    </span>
                    <div class="left__content">
                        <div class="left__logo">
                            <img src=".public/images/logo.png" alt="">
                            <span>SELLER</span>
                        </div>

                        <ul class="left__menu">
                            <li class="left__menuItem">
                                <a href="index.html" class="left__title"><img src="seller/assets/icon-dashboard.svg" alt=""><span> Dashboard</span></a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="seller/assets/icon-tag.svg" alt=""><span>Sản Phẩm</span><input type="checkbox" class="white__font" id="tt__left">
                                    <i id="light" class="fas fa-chevron-right left__iconDown"></i></div>
                                <div class="left__text">
                                    <a class="left__link" href="seller.php?ctrl=products&act=insert">Thêm sản phẩm</a>
                                    <a class="left__link" href="seller.php?ctrl=products">Xem Sản Phẩm</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="seller/assets/icon-edit.svg" alt=""><span>Danh Mục SP</span> <input type="checkbox" class="white__font" id="tt__left">
                                    <i id="light" class="fas fa-chevron-right left__iconDown"></i></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_p_category.html">Chèn Danh Mục</a>
                                    <a class="left__link" href="view_p_category.html">Xem Danh Mục</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="seller/assets/icon-book.svg" alt=""><span>Thể Loại</span> <input type="checkbox" class="white__font" id="tt__left">
                                    <i id="light" class="fas fa-chevron-right left__iconDown"></i></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_category.html">Chèn Thể Loại</a>
                                    <a class="left__link" href="view_category.html">Xem Thể Loại</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="seller/assets/icon-settings.svg" alt=""><span>Slide</span><input type="checkbox" class="white__font" id="tt__left">
                                    <i id="light" class="fas fa-chevron-right left__iconDown"></i></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_slide.html">Chèn Slide</a>
                                    <a class="left__link" href="view_slides.html">Xem Slide</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="seller/assets/icon-book.svg" alt=""><span>Coupons</span> <input type="checkbox" class="white__font" id="tt__left">
                                    <i id="light" class="fas fa-chevron-right left__iconDown"></i></div>

                                <div class="left__text">
                                    <a class="left__link" href="insert_coupon.html">Chèn Coupon</a>
                                    <a class="left__link" href="view_coupons.html">Xem Coupons</a>
                                </div>

                            </li>
                            <li class="left__menuItem">
                                <a href="view_customers.html" class="left__title"><img src="seller/assets/icon-users.svg" alt="">Khách Hàng</a>
                            </li>
                            <li class="left__menuItem">
                                <a href="view_orders.html" class="left__title"><img src="seller/assets/icon-book.svg" alt="">Đơn Đặt Hàng</a>
                            </li>
                            <li class="left__menuItem">
                                <a href="edit_css.html" class="left__title"><img src="seller/assets/icon-pencil.svg" alt="">Chỉnh CSS</a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="seller/assets/icon-user.svg" alt=""><span>Admin</span><input type="checkbox" class="white__font" id="tt__left">
                                    <i id="light" class="fas fa-chevron-right left__iconDown"></i></div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_admin.html">Chèn Admin</a>
                                    <a class="left__link" href="view_admins.html">Xem Admins</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="seller.php?ctrl=account&act=logout" class="left__title"><img src="seller/assets/icon-logout.svg" alt="">Đăng Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <?php

                    $index_file = 'seller/controller/home.php';
                    if(isset($_GET['ctrl']) && $_GET['ctrl'])   
                    {
                        $filename = 'seller/controller/'.$_GET['ctrl'].'.php';
                        include (file_exists($filename)) ? $filename : $index_file;
                    }
                    else
                        include $index_file;

                ?>

                <div id="dark2" class="right">

                    <div class="right__profile">
                        <div class="right__image">
                            <img src=".public/images/seller/profile.jpg" alt="">
                            <div class="right__image__edit">
                                <i class="fa fa-camera" style="font-size:12px"></i>
                            </div>
                        </div>
                    </div>

                    <div class="info__bell">
                        <i class='far fa-bell'> <div class="dot">2</div></i>
                    </div>
                    <div class="info__bell mt">
                        <i style="font-size: 21px;" class='far fa-comment'> <div class="dot">1</div></i>

                    </div>
                    <hr class="line">
                    <div class="button__hidden">
                        <div class="container__button">
                            <!-- <div class="toggle__btn " onclick="this.classList.toggle('active')"> -->
                            <!-- <i id="click__me" class="fa fa-circle-o"></i> -->

                            <input type="checkbox" class="checkbox" id="checkbox">
                            <label for="checkbox" class="label">
                                <i class="far fa-moon"></i>
                                <i class="fas fa-sun"></i>
                                <div class="ball"></div>
                            </label>

                            <!-- 
                            </div> -->

                        </div>
                    </div>
                    <hr class="line">
                    <div class="qr__code mt edit">
                        <i class="fa fa-qrcode"></i>
                    </div>
                    <div class="info mt edit">
                        <i class="fa fa-info-circle "></i>
                    </div>
                    <div class="info__set mt edit">
                        <i class="fa fa-gear"></i>
                    </div>
                    <div class="right__hover">
                        <div class="info__top">
                            <li><?= $_SESSION['sbs_name_seller'] ?></li>
                            <li>SĐT : <?= $_SESSION['sbs_tel_seller'] ?></li>
                            <li>Gian hàng: <?= $_SESSION['sbs_mart_seller'] ?></li>

                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=".public/js/seller/main.js"></script>
</body>

<?php
    }
    else
    {
        if(isset($_GET['ctrl']) && $_GET['ctrl'] == 'account')
        {
            if(isset($_GET['act']) && ($_GET['act'] == 'signin' || $_GET['act'] == 'signup'))
            {
                $filename = 'seller/controller/'.$_GET['ctrl'].'.php';
                if(file_exists($filename))
                    include $filename;
                else
                    header('location: seller.php?ctrl=account&act=signin');
            }
        }
        else
            header('location: seller.php?ctrl=account&act=signin');
    }

    ob_end_flush();
?>
