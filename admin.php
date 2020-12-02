<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sbs_id']) && $_SESSION['sbs_id'] > 0 && $_SESSION['sbs_role'] >= 30)
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

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Meta -->
        <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
        <meta name="author" content="BootstrapDash">

        <title>sbs's admin</title>

        <!-- global CSS -->
        <link rel="stylesheet" href=".public/css/admin/style.css">

    </head>
    
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
    <div class="az-footer ht-40">
        <div class="container ht-100p pd-t-0-f">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                <a href="#">sidebyside.shop</a>
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">sidebyside.shop's admin</span>
        </div>
    </div>

    <script src=".system/lib/admin/jquery/jquery.min.js"></script>
    <script src=".system/lib/admin/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src=".system/lib/admin/ionicons/ionicons.js"></script>
    <script src=".system/lib/admin/jquery.flot/jquery.flot.js"></script>
    <script src=".system/lib/admin/jquery.flot/jquery.flot.resize.js"></script>
    <script src=".system/lib/admin/chart.js/Chart.bundle.min.js"></script>
    <script src=".system/lib/admin/peity/jquery.peity.min.js"></script>

    <script src=".public/js/admin/azia.js"></script>
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