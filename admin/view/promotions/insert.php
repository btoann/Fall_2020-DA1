<!-- vendor css -->
<link href=".system/lib/admin/spectrum-colorpicker/spectrum.css" rel="stylesheet">
<link href=".system/lib/admin/select2/css/select2.min.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
<link href=".system/lib/admin/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
<link href=".system/lib/admin/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
<link href=".system/lib/admin/pickerjs/picker.min.css" rel="stylesheet">

<!-- flatpickr_4.2.3.css -->
<link href=".system/lib/flatpickr_4.2.3/flatpickr.css" rel="stylesheet">

<div class="sbs-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
    
        <?php
            include_once 'menu.php';
        ?>

        <div class="sbs-content-body pd-lg-l-40 d-flex flex-column">
            <div class="sbs-content-breadcrumb">
                <span><a href="admin.php">Admin</a></span>
                <span><a href="admin.php?ctrl=promotions">Khuyến mãi</a></span>
                <span>Thêm Khuyến mãi</span>
            </div>
            <h2 class="sbs-content-title">Thêm khuyến mãi</h2>
            <!-- <div class="sbs-content-label mg-b-5">#1 - Simple Table</div>
            <p class="mg-b-15">admin - 01/01/2001</p> -->

            <form class="" action="admin.php?ctrl=promotions&act=insert" method="post">
                <div class="row row-sm mg-b-20">
                    <div class="col-lg-8 needs-validation was-validated">
                        <p class="sbs-content-label mg-b-10">Tên khuyến mãi</p>
                        <div class="form-group has-success mg-b-0">
                            <input class="form-control" placeholder="Tên khuyến mãi" name="name" required type="text">
                        </div><!-- form-group -->
                    </div><!-- col -->
                    <div class="col-lg-4 mg-t-20 mg-lg-t-0 needs-validation was-validated">
                        <p class="sbs-content-label mg-b-10">Giảm giá (%)</p>
                        <div class="form-group has-success mg-b-0">
                            <input class="form-control" placeholder="Giảm giá" name="discount" required type="number">
                        </div><!-- form-group -->
                    </div><!-- col-4 -->
                </div><!-- row -->
                <div class="row row-sm mg-b-20">
                    <div class="col-lg-4">
                        <p class="sbs-content-label mg-b-10">Ngày bắt đầu</p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input type="text" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date('Y-m-d h:00:00') ?>" name="begin" id="begin" data-input="" class="flatpickr-input form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4 mg-b-20">
                        <p class="sbs-content-label mg-b-10">Ngày kết thúc</p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input type="text" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date('Y-m-d h:00:00', strtotime('+1 week')) ?>" name="end" id="end" class="form-control flatpickr-input">
                        </div>
                    </div>
                    <div class=" col-lg-8">
                        <p class="sbs-content-label mg-b-10">Nội dung khuyến mãi</p>
                        <textarea rows="8" class="form-control mg-t-5" placeholder="Mô tả" name="description" required></textarea>
                    </div>
                </div><!-- row -->

                <div class="row row-xs wd-xl-80p">
                    <div class="col-sm-6 col-md-3">
                        <input type="submit" value="Thêm khuyến mãi" name="insert" class="btn btn-main btn-block">
                    </div>
                </div>
            </form>

            <hr class="mg-y-30">

            <!-- Date box -->
            <div class="ht-40"></div>
            <!-- <div class="flatpickr-calendar animate arrowTop open" tabindex="-1" style="top: 195.5px; left: 238.2px; right: auto;">
                <div class="flatpickr-month"><span class="flatpickr-prev-month" style="display: block;"><svg version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 17">
                            <g></g>
                            <path d="M5.207 8.471l7.146 7.147-0.707 0.707-7.853-7.854 7.854-7.853 0.707 0.707-7.147 7.146z"></path>
                        </svg></span>
                    <div class="flatpickr-current-month"><span class="cur-month" title="Scroll to increment">December </span>
                        <div class="numInputWrapper"><input class="numInput cur-year" type="text" pattern="\d*" tabindex="-1"
                                title="Scroll to increment"><span class="arrowUp"></span><span class="arrowDown"></span></div>
                    </div><span class="flatpickr-next-month" style="display: block;"><svg version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 17 17">
                            <g></g>
                            <path d="M13.207 8.472l-7.854 7.854-0.707-0.707 7.146-7.146-7.146-7.148 0.707-0.707 7.854 7.854z">
                            </path>
                        </svg></span>
                </div>
                <div class="flatpickr-innerContainer">
                    <div class="flatpickr-rContainer">
                        <div class="flatpickr-weekdays">
                            <span class="flatpickr-weekday">
                                Sun</span><span class="flatpickr-weekday">Mon</span><span class="flatpickr-weekday">Tue</span><span
                                class="flatpickr-weekday">Wed</span><span class="flatpickr-weekday">Thu</span><span
                                class="flatpickr-weekday">Fri</span><span class="flatpickr-weekday">Sat
                            </span>
                        </div>
                        <div class="flatpickr-days" tabindex="-1">
                            <div class="dayContainer"><span class="flatpickr-day " aria-label="December 1, 2019"
                                    tabindex="-1">1</span><span class="flatpickr-day " aria-label="December 2, 2019"
                                    tabindex="-1">2</span><span class="flatpickr-day " aria-label="December 3, 2019"
                                    tabindex="-1">3</span><span class="flatpickr-day " aria-label="December 4, 2019"
                                    tabindex="-1">4</span><span class="flatpickr-day " aria-label="December 5, 2019"
                                    tabindex="-1">5</span><span class="flatpickr-day " aria-label="December 6, 2019"
                                    tabindex="-1">6</span><span class="flatpickr-day " aria-label="December 7, 2019"
                                    tabindex="-1">7</span><span class="flatpickr-day " aria-label="December 8, 2019"
                                    tabindex="-1">8</span><span class="flatpickr-day " aria-label="December 9, 2019"
                                    tabindex="-1">9</span><span class="flatpickr-day " aria-label="December 10, 2019"
                                    tabindex="-1">10</span><span class="flatpickr-day " aria-label="December 11, 2019"
                                    tabindex="-1">11</span><span class="flatpickr-day " aria-label="December 12, 2019"
                                    tabindex="-1">12</span><span class="flatpickr-day " aria-label="December 13, 2019"
                                    tabindex="-1">13</span><span class="flatpickr-day " aria-label="December 14, 2019"
                                    tabindex="-1">14</span><span class="flatpickr-day " aria-label="December 15, 2019"
                                    tabindex="-1">15</span><span class="flatpickr-day " aria-label="December 16, 2019"
                                    tabindex="-1">16</span><span class="flatpickr-day " aria-label="December 17, 2019"
                                    tabindex="-1">17</span><span class="flatpickr-day " aria-label="December 18, 2019"
                                    tabindex="-1">18</span><span class="flatpickr-day " aria-label="December 19, 2019"
                                    tabindex="-1">19</span><span class="flatpickr-day " aria-label="December 20, 2019"
                                    tabindex="-1">20</span><span class="flatpickr-day " aria-label="December 21, 2019"
                                    tabindex="-1">21</span><span class="flatpickr-day " aria-label="December 22, 2019"
                                    tabindex="-1">22</span><span class="flatpickr-day " aria-label="December 23, 2019"
                                    tabindex="-1">23</span><span class="flatpickr-day " aria-label="December 24, 2019"
                                    tabindex="-1">24</span><span class="flatpickr-day " aria-label="December 25, 2019"
                                    tabindex="-1">25</span><span class="flatpickr-day " aria-label="December 26, 2019"
                                    tabindex="-1">26</span><span class="flatpickr-day " aria-label="December 27, 2019"
                                    tabindex="-1">27</span><span class="flatpickr-day " aria-label="December 28, 2019"
                                    tabindex="-1">28</span><span class="flatpickr-day " aria-label="December 29, 2019"
                                    tabindex="-1">29</span><span class="flatpickr-day " aria-label="December 30, 2019"
                                    tabindex="-1">30</span><span class="flatpickr-day " aria-label="December 31, 2019"
                                    tabindex="-1">31</span><span class="flatpickr-day nextMonthDay" aria-label="January 1, 2020"
                                    tabindex="-1">1</span><span class="flatpickr-day nextMonthDay" aria-label="January 2, 2020"
                                    tabindex="-1">2</span><span class="flatpickr-day nextMonthDay" aria-label="January 3, 2020"
                                    tabindex="-1">3</span><span class="flatpickr-day nextMonthDay" aria-label="January 4, 2020"
                                    tabindex="-1">4</span><span class="flatpickr-day nextMonthDay" aria-label="January 5, 2020"
                                    tabindex="-1">5</span><span class="flatpickr-day nextMonthDay" aria-label="January 6, 2020"
                                    tabindex="-1">6</span><span class="flatpickr-day nextMonthDay" aria-label="January 7, 2020"
                                    tabindex="-1">7</span><span class="flatpickr-day nextMonthDay" aria-label="January 8, 2020"
                                    tabindex="-1">8</span><span class="flatpickr-day nextMonthDay" aria-label="January 9, 2020"
                                    tabindex="-1">9</span><span class="flatpickr-day nextMonthDay" aria-label="January 10, 2020"
                                    tabindex="-1">10</span><span class="flatpickr-day nextMonthDay" aria-label="January 11, 2020"
                                    tabindex="-1">11</span></div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div><!-- sbs-content-body -->
    </div><!-- container -->
</div><!-- sbs-content -->


<script defer src=".system/lib/admin/jquery-ui/ui/widgets/datepicker.js"></script>
<script defer src=".system/lib/admin/spectrum-colorpicker/spectrum.js"></script>
<script defer src=".system/lib/admin/jquery.maskedinput/jquery.maskedinput.js"></script>
<script defer src=".system/lib/admin/select2/js/select2.min.js"></script>
<script defer src=".system/lib/admin/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<script defer src=".system/lib/admin/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>
<script defer src=".system/lib/admin/jquery-simple-datetimepicker/jquery.simple-dtpicker.js"></script>
<script defer src=".system/lib/admin/pickerjs/picker.min.js"></script>

<!-- flatpickr_4.2.3.js -->
<script src=".system/lib/flatpickr_4.2.3/flatpickr.js"></script>

<script defer scr=".public/js/admin/promotions/insert.js"></script>
  <!--  Flatpickr  -->

<script defer>
    $("#begin").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i:ss"
    });
    $("#end").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i:ss"
    });
</script>