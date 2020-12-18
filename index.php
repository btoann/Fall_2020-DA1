<?php
    ob_start();
    session_start();

    include_once '.system/lib/controller.php';
    // Khởi động event trên Database
    event_scheduler('on');

    if(!(isset($_GET['ctrl']) && ($_GET['ctrl'] == 'account' || $_GET['ctrl'] == 'ajax')))
    {
        include 'client/model/categories.php';
        $index_ui_categories = index_ui_categories(15);
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
    <script src=".public/js/jquery_3.5.1.js"></script>
</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <a href="index.php"><img src=".public/images/logo.png" alt="" /></a>
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
                            if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
                            {
                                if($_SESSION['sbs_user']['role'] >= 30) 
                                    echo
                                        '<a href="index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id'].'">'.$_SESSION['sbs_user']['name'].'</i></a>
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
                                                        <a href="index.php?ctrl=categories&id='.$index_category['id'].'" class="hl-hv"><strong>'.$index_category['name'].'</strong></a>
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
                            <form action="index.php?ctrl=products&act=search" method="post" id="search_form">
                            </form>
                            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm, danh mục, đại lý..." id="search" form="search_form"/>
                            <a href="#"><i class="fas fa-search"></i></a>
                            <!-- <div class="search_result box_shadow_1" id="search_result">
                            </div> -->
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


    <div class="Container-itwfbd-0 jFkAwY" style="height: 100px; padding-top: 32px">
        <div class="NewsLetter-icon">
            <img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/newsletter.png" width="163" alt="" />
        </div>
        <div class="NewsLetter-description">
            <h3>Đăng ký nhận bản tin Side by Side</h3>
            <h5>Đừng bỏ lỡ hàng ngàn sản phẩm và chương trình siêu hấp dẫn</h5>
        </div>
        <div class="NewsLetter-form">
            <div>
                <input type="email" placeholder="Địa chỉ email của bạn" value="" />
            </div>
            <button>Đăng ký</button>
        </div>
    </div>
    <div class="Footer__Information-e3clg6-3 dZezzK">
        <div class="Container-itwfbd-0 jFkAwY" style="display: flex; justify-content: space-between">
            <div class="block" style="width: 268px">
                <h4>HỖ TRỢ KHÁCH HÀNG</h4>
                <p class="hotline">
                    Hotline chăm sóc khách hàng:
                    <a href="tel:1900-6035">1900-6035</a><span class="small-text">(1000đ/phút , 8-21h kể cả T7, CN)</span>
                </p>
                <a rel="noreferrer" href="https://hotro.tiki.vn/hc/vi" class="small-text" target="_blank">Các câu hỏi thường gặp</a><a
                    rel="noreferrer" href="https://hotro.tiki.vn/hc/vi/requests/new" class="small-text" target="_blank">Gửi yêu cầu hỗ
                    trợ</a><a rel="noreferrer" href="https://hotro.tiki.vn/hc/vi/categories/200126644" class="small-text"
                    target="_blank">Hướng dẫn đặt hàng</a><a rel="noreferrer" href="https://hotro.tiki.vn/hc/vi/categories/200123960"
                    class="small-text" target="_blank">Phương thức vận chuyển</a><a rel="noreferrer"
                    href="https://tiki.vn/doi-tra-de-dang" class="small-text" target="_blank">Chính sách đổi trả</a><a rel="noreferrer"
                    href="https://tiki.vn/chuong-trinh/dieu-kien-tra-gop" class="small-text" target="_blank">Hướng dẫn trả góp</a><a
                    rel="noreferrer" href="https://hotro.tiki.vn/hc/vi/articles/360000822643" class="small-text" target="_blank">Chính
                    sách hàng nhập khẩu</a>
                <p class="security">
                    Hỗ trợ khách hàng:
                    <a href="mailto:hotro@tiki.vn">hotro@sidebyside.vn</a>
                </p>
                <p class="security">
                    Báo lỗi bảo mật:
                    <a href="mailto:security@tiki.vn">security@sidebyside.vn</a>
                </p>
            </div>
            <div class="block">
                <h4>VỀ Side by Side</h4>
                <a rel="noreferrer" href="https://tiki.vn/gioi-thieu-ve-tiki" class="small-text" target="_blank">Giới thiệu
                    sidebyside</a><a rel="noreferrer" href="https://tuyendung.tiki.vn" class="small-text" target="_blank">Tuyển
                    Dụng</a><a rel="noreferrer" href="https://tiki.vn/bao-mat-thanh-toan" class="small-text" target="_blank">Chính
                    sách bảo mật thanh toán</a><a rel="noreferrer" href="https://tiki.vn/bao-mat-thong-tin-ca-nhan"
                    class="small-text" target="_blank">Chính sách bảo mật thông tin cá nhân</a><a rel="noreferrer"
                    href="https://hotro.tiki.vn/hc/vi/articles/115005575826" class="small-text" target="_blank">Chính sách giải
                    quyết khiếu nại</a><a rel="noreferrer" href="https://hotro.tiki.vn/hc/vi/articles/201971214" class="small-text"
                    target="_blank">Điều khoản sử dụng</a><a rel="noreferrer"
                    href="https://hotro.tiki.vn/hc/vi/articles/201710754-Tiki-Xu-l%C3%A0-g%C3%AC-Gi%C3%A1-tr%E1%BB%8B-quy-%C4%91%E1%BB%95i-nh%C6%B0-th%E1%BA%BF-n%C3%A0o"
                    class="small-text" target="_blank">Giới thiệu Tiki Xu</a><a rel="noreferrer"
                    href="https://tiki.vn/chuong-trinh/ban-hang-doanh-nghiep" class="small-text" target="_blank">Bán hàng doanh nghiệp
                </a>
            </div>
            <div class="block">
                <h4>HỢP TÁC VÀ LIÊN KẾT</h4>
                <a rel="noreferrer" href="https://tiki.vn/quy-che-hoat-dong-sgdtmdt" class="small-text" target="_blank">Quy chế hoạt
                    động Sàn GDTMĐT</a><a rel="noreferrer" href="https://tiki.vn/ban-hang-cung-tiki" class="small-text"
                    target="_blank">Bán hàng cùng sidebyside
                </a>
            </div>
            <div class="block">
                <h4>PHƯƠNG THỨC THANH TOÁN</h4>
                <p>
                    <img class="icon" src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/visa.svg" width="54"
                        alt="" /><img class="icon" src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/mastercard.svg"
                        width="54" alt="" /><img class="icon"
                        src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/jcb.svg" width="54" alt="" /><img
                        class="icon" src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/cash.svg" width="54"
                        alt="" /><img class="icon"
                        src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/internet-banking.svg" width="54"
                        alt="" /><img class="icon"
                        src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/installment.svg" width="54" alt="" />
                </p>
            </div>
            <div class="block">
                <h4>KẾT NỐI VỚI CHÚNG TÔI</h4>
                <p>
                    <a rel="noreferrer" href="https://www.facebook.com/Side-by-Side-100311098633597" class="icon" target="_blank"
                        title="Facebook"><img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/fb.svg" width="32"
                            alt="" /></a><a rel="noreferrer"
                        href="https://www.youtube.com/channel/UC_uV8IYP4XF8R0acsXfERAg?view_as=subscriber" class="icon"
                        target="_blank" title="Youtube"><img
                            src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/youtube.svg" width="32"
                            alt="" /></a><a rel="noreferrer" href="http://zalo.me/589673439383195103" class="icon" target="_blank"
                        title="Zalo"><i class="icon tikicon icon-footer-zalo"></i></a>
                </p>
                <h4 class="store-title">TẢI ỨNG DỤNG TRÊN ĐIỆN THOẠI</h4>
                <p>
                    <a rel="noreferrer" href="https://itunes.apple.com/vn/app/id958100553" class="icon" target="_blank"
                        aria-label=""><img src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/appstore.png"
                            width="134" alt="" /></a>
                    <a rel="noreferrer" href="https://play.google.com/store/apps/details?id=vn.tiki.app.tikiandroid" class="icon"
                        target="_blank" aria-label=""><img
                            src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/playstore.png" width="134"
                            alt="" />
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src=".public/js/client/search.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://kit.fontawesome.com/978d2e326d.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    var dh = null;

    function tg() {
        var now = new Date();
        var h = now.getHours();
        var m = now.getMinutes();
        var s = now.getSeconds();
        document.getElementById("dongho").innerHTML = h + ":" + m + ":" + s;
    }
</script>
<script>
    dh = setInterval("tg()", 1000);
</script>
<script>
    function starstopdh() {
        if (dh == null) {
            dh = setInterval("tg()", 1000);
        } else {
            clearInterval(dh);
            dh = null;
        }
    }
</script>
<script>
    $(document).ready(function () {
        $(".carousel").slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 6,
            prevArrow: `<button type="button" class="slick-prev prev-arrow-carousel">Previous</button>`,
            nextArrow: `<button type="button" class="slick-next next-arrow-carousel">Next</button>`,
        });
    });
</script>
<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
</script>
</body>

</html>


<!-- Signin/Signout -->

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