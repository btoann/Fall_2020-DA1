<?php
    ob_start();
    session_start();

    include_once '.system/lib/controller.php';
    // Khởi động event trên Database
    event_scheduler('on');

    if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0 && $_SESSION['sbs_user']['role'] >= 30)
    {
?>

<!DOCTYPE html>
<html>
    
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());

            gtag('config', 'UA-90680653-2');
        </script>
        <script async src=".system/lib/admin/jquery/jquery.min.js"></script>
        <script async src=".public/js/sweetalert.min.js"></script>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Meta -->
        <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
        <meta name="author" content="BootstrapDash">

        <title>sbs's admin</title>

        <!-- global CSS -->
        <link rel="stylesheet" href=".public/css/admin/style.css">
        <link rel="stylesheet" href=".public/css/_style.css">
        <link rel="stylesheet" href=".public/icons/css/fontello.css">
        
        <!-- vendor css -->
        <link href=".system/lib/admin/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href=".system/lib/admin/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link href=".system/lib/admin/typicons.font/typicons.css" rel="stylesheet">
        <link href=".system/lib/admin/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">

    </head>
    
    <div class="sbs-header">
        <div class="container">
            <div class="sbs-header-left">
            <a href="index.php" class="sbs-logo bside-txt"><span></span>
                <span></span>s<span class="gray-txt">b</span><span class="hl-txt">s</span>'s admin
            </a>
            <a href="" id="azMenuShow" class="sbs-header-menu-icon d-lg-none"><span></span></a>
            </div><!-- sbs-header-left -->
            <div class="sbs-header-menu">
            <div class="sbs-header-menu-header">
                <a href="admin.php" class="sbs-logo bside-txt">
                <span></span>s<span class="gray-txt">b</span><span class="hl-txt">b</span>'s admin
                </a>
                <a href="" class="close">&times;</a>
            </div><!-- sbs-header-menu-header -->
            <ul class="nav">
                <li class="nav-item <?= (!isset($_GET['ctrl'])) ? 'active show' : '' ?>">
                    <a href="admin.php" class="nav-link bside-txt"><i class="icon-chart-bar"></i>&ensp;Thống kê</a>
                </li>
                <li class="nav-item <?= (isset($_GET['ctrl']) && $_GET['ctrl'] == 'categories') ? 'active show' : '' ?>">
                    <a href="admin.php?ctrl=categories" class="nav-link bside-txt"><i class="icon-list-nested"></i>&ensp;Danh mục</a>
                </li>
                <li class="nav-item <?= (isset($_GET['ctrl']) && $_GET['ctrl'] == 'account') ? 'active show' : '' ?>">
                    <a href="admin.php?ctrl=promotions" class="nav-link"><i class="icon-percent"></i>&ensp;Khuyến mãi</a>
                </li>
                <li class="nav-item <?= (isset($_GET['ctrl']) && $_GET['ctrl'] == 'account') ? 'active show' : '' ?>">
                    <a href="admin.php?ctrl=account" class="nav-link"><i class="icon-user-outline"></i>&ensp;Người dùng</a>
                </li>
                <li class="nav-item">
                <a href="" class="nav-link with-sub"><i class="typcn typcn-book"></i> Other</a>
                <div class="sbs-menu-sub">
                    <div class="container">
                    <div>
                        <nav class="nav">
                        <a href="#" class="nav-link">Buttons</a>
                        <a href="#" class="nav-link">Dropdown</a>
                        <a href="#" class="nav-link">Icons</a>
                        <a href="#" class="nav-link">Table</a>
                        </nav>
                    </div>
                    </div><!-- container -->
                </div>
                </li>
            </ul>
            </div><!-- sbs-header-menu -->
            <div class="sbs-header-right">
            <a href="https://www.bootstrapdash.com/demo/azia-free/docs/documentation.html" target="_blank"
                class="sbs-header-search-link"><i class="far fa-file-alt"></i></a>
            <a href="" class="sbs-header-search-link"><i class="fas fa-search"></i></a>
            <div class="sbs-header-message">
                <a href="#"><i class="typcn typcn-messages"></i></a>
            </div><!-- sbs-header-message -->
            <div class="dropdown sbs-header-notification">
                <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                <div class="sbs-dropdown-header mg-b-20 d-sm-none">
                    <a href="" class="sbs-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <h6 class="sbs-notification-title">Notifications</h6>
                <p class="sbs-notification-text">You have 2 unread notification</p>
                <div class="sbs-notification-list">
                    <div class="media new">
                    <div class="sbs-img-user"><img src="../img/faces/face2.jpg" alt=""></div>
                    <div class="media-body">
                        <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                        <span>Mar 15 12:32pm</span>
                    </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media new">
                    <div class="sbs-img-user online"><img src="../img/faces/face3.jpg" alt=""></div>
                    <div class="media-body">
                        <p><strong>Joyce Chua</strong> just created a new blog post</p>
                        <span>Mar 13 04:16am</span>
                    </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                    <div class="sbs-img-user"><img src="../img/faces/face4.jpg" alt=""></div>
                    <div class="media-body">
                        <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                        <span>Mar 13 02:56am</span>
                    </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                    <div class="sbs-img-user"><img src="../img/faces/face5.jpg" alt=""></div>
                    <div class="media-body">
                        <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                        <span>Mar 12 10:40pm</span>
                    </div><!-- media-body -->
                    </div><!-- media -->
                </div><!-- sbs-notification-list -->
                <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                </div><!-- dropdown-menu -->
            </div><!-- sbs-header-notification -->
            <div class="dropdown sbs-profile-menu">
                <a href="" class="sbs-img-user"><img src="../img/faces/face1.jpg" alt=""></a>
                <div class="dropdown-menu">
                <div class="sbs-dropdown-header d-sm-none">
                    <a href="" class="sbs-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="sbs-header-profile">
                    <div class="sbs-img-user">
                    <img src="../img/faces/face1.jpg" alt="">
                    </div><!-- sbs-img-user -->
                    <h6>Aziana Pechon</h6>
                    <span>Premium Member</span>
                </div><!-- sbs-header-profile -->

                <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                <a href="page-signin.html" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
                </div><!-- dropdown-menu -->
            </div>
            </div><!-- sbs-header-right -->
        </div><!-- container -->
    </div><!-- sbs-header -->

    <?php

        $index_file = 'admin/controller/home.php';
        if(isset($_GET['ctrl']) && $_GET['ctrl'])
        {
            $filename = 'admin/controller/'.$_GET['ctrl'].'.php';
            include (file_exists($filename)) ? $filename : $index_file;
        }
        else
            include $index_file;

    ?>

    <!-- Footer -->
    <div class="sbs-footer ht-40">
        <div class="container ht-100p pd-t-0-f">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                <a href="index.php">sidebyside.shop</a>
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">sidebyside.shop's admin</span>
        </div>
    </div>

    <script src=".system/lib/admin/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src=".system/lib/admin/ionicons/ionicons.js"></script>
    <script src=".system/lib/admin/jquery.flot/jquery.flot.js"></script>
    <script src=".system/lib/admin/jquery.flot/jquery.flot.resize.js"></script>
    <script src=".system/lib/admin/chart.js/Chart.bundle.min.js"></script>
    <script src=".system/lib/admin/peity/jquery.peity.min.js"></script>

    <script src=".public/js/admin/sidebyside.js"></script>
    <script src=".public/js/admin/chart.flot.sampledata.js"></script>
    <script src=".public/js/admin/dashboard.sampledata.js"></script>
    <script src=".public/js/admin/jquery.cookie.js" type="text/javascript"></script>
    <script>
        $(function () {
        'use strict'

        var plot = $.plot('#flotChart', [{
            data: flotSampleData3,
            color: 'red',
            lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }] }
            }
        }, {
            data: flotSampleData4,
            color: '#560bd0',
            lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }] }
            }
        }], {
            series: {
            shadowSize: 0,
            lines: {
                show: true,
                lineWidth: 2,
                fill: true
            }
            },
            grid: {
            borderWidth: 0,
            labelMargin: 8
            },
            yaxis: {
            show: true,
            min: 0,
            max: 100,
            ticks: [[0, ''], [20, '20K'], [40, '40K'], [60, '60K'], [80, '80K']],
            tickColor: '#eee'
            },
            xaxis: {
            show: true,
            color: '#fff',
            ticks: [[25, 'OCT 21'], [75, 'OCT 22'], [100, 'OCT 23'], [125, 'OCT 24']],
            }
        });

        $.plot('#flotChart1', [{
            data: dashData2,
            color: '#00cccc'
        }], {
            series: {
            shadowSize: 0,
            lines: {
                show: true,
                lineWidth: 2,
                fill: true,
                fillColor: { colors: [{ opacity: 0.2 }, { opacity: 0.2 }] }
            }
            },
            grid: {
            borderWidth: 0,
            labelMargin: 0
            },
            yaxis: {
            show: false,
            min: 0,
            max: 35
            },
            xaxis: {
            show: false,
            max: 50
            }
        });

        $.plot('#flotChart2', [{
            data: dashData2,
            color: '#007bff'
        }], {
            series: {
            shadowSize: 0,
            bars: {
                show: true,
                lineWidth: 0,
                fill: 1,
                barWidth: .5
            }
            },
            grid: {
            borderWidth: 0,
            labelMargin: 0
            },
            yaxis: {
            show: false,
            min: 0,
            max: 35
            },
            xaxis: {
            show: false,
            max: 20
            }
        });


        //-------------------------------------------------------------//


        // Line chart
        $('.peity-line').peity('line');

        // Bar charts
        $('.peity-bar').peity('bar');

        // Bar charts
        $('.peity-donut').peity('donut');

        var ctx5 = document.getElementById('chartBar5').getContext('2d');
        new Chart(ctx5, {
            type: 'bar',
            data: {
            labels: [0, 1, 2, 3, 4, 5, 6, 7],
            datasets: [{
                data: [2, 4, 10, 20, 45, 40, 35, 18],
                backgroundColor: '#560bd0'
            }, {
                data: [3, 6, 15, 35, 50, 45, 35, 25],
                backgroundColor: '#cad0e8'
            }]
            },
            options: {
            maintainAspectRatio: false,
            tooltips: {
                enabled: false
            },
            legend: {
                display: false,
                labels: {
                display: false
                }
            },
            scales: {
                yAxes: [{
                display: false,
                ticks: {
                    beginAtZero: true,
                    fontSize: 11,
                    max: 80
                }
                }],
                xAxes: [{
                barPercentage: 0.6,
                gridLines: {
                    color: 'rgba(0,0,0,0.08)'
                },
                ticks: {
                    beginAtZero: true,
                    fontSize: 11,
                    display: false
                }
                }]
            }
            }
        });

        // Donut Chart
        var datapie = {
            labels: ['Search', 'Email', 'Referral', 'Social', 'Other'],
            datasets: [{
            data: [25, 20, 30, 15, 10],
            backgroundColor: ['#6f42c1', '#007bff', '#17a2b8', '#00cccc', '#adb2bd']
            }]
        };

        var optionpie = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
            display: false,
            },
            animation: {
            animateScale: true,
            animateRotate: true
            }
        };

        // For a doughnut chart
        var ctxpie = document.getElementById('chartDonut');
        var myPieChart6 = new Chart(ctxpie, {
            type: 'doughnut',
            data: datapie,
            options: optionpie
        });

        });
    </script>
    </body>
</html>

<?php
    }
    else
    {
        header('location: index.php');
    }
    ob_end_flush();
?>