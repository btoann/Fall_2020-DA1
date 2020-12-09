<!-- vendor css -->
<link href=".system/lib/admin/spectrum-colorpicker/spectrum.css" rel="stylesheet">
<link href=".system/lib/admin/select2/css/select2.min.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
<link href=".system/lib/admin/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
<link href=".system/lib/admin/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
<link href=".system/lib/admin/pickerjs/picker.min.css" rel="stylesheet">

<script defer src=".public/js/admin/categories/insert.js"></script>

<div class="sbs-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
    
        <?php
            include_once 'menu.php';
        ?>

        <div class="sbs-content-body pd-lg-l-40 d-flex flex-column">
            <div class="sbs-content-breadcrumb">
                <span><a href="admin.php">Admin</a></span>
                <span><a href="admin.php?ctrl=categories">Danh mục</a></span>
                <span>Thêm danh mục</span>
            </div>
            <h2 class="sbs-content-title">Thêm danh mục</h2>
            <!-- <div class="sbs-content-label mg-b-5">#1 - Simple Table</div>
            <p class="mg-b-15">admin - 01/01/2001</p> -->

            <form class="" action="admin.php?ctrl=categories&act=insert" method="post">
                <div class="row row-sm mg-b-20">
                    <div class="col-lg-8 needs-validation was-validated">
                        <p class="sbs-content-label mg-b-10">Tên danh mục</p>
                        <div class="form-group has-success mg-b-0">
                            <input class="form-control" placeholder="Tên danh mục" name="name" required type="text">
                        </div><!-- form-group -->
                    </div><!-- col -->
                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                        <p class="sbs-content-label mg-b-10">Danh mục cha</p>
                        <select class="form-control select2" name="parent" id="parent_category">
                            <option value="0">-- Không chọn --</option>
                            <?php
                                foreach($getParent_categories as $parent)
                                {
                                    echo '<option value="'.$parent['id'].'">'.$parent['name'].'</option>';
                                }
                            ?>
                        </select>
                    </div><!-- col-4 -->
                </div><!-- row -->
                <div class="row row-sm mg-b-20 hide" id="hashtags_checkbox">
                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                        <label class="ckbox" id="check_insert">
                            <input type="checkbox" name="check_hashtag"><span class="sbs-content-label">Phân nhánh danh mục</span>
                        </label>
                    </div><!-- col-4 -->
                </div><!-- row -->
                <div class="hide" id="hashtags_insert">
                <div class="row row-sm mg-b-40">
                    <div class="col-lg-3 mg-b-10">
                        <input class="form-control" placeholder="#hashtag" type="text" name="hashtags[]">
                    </div>
                    <span class="btn btn-icon main-txt hl-hv mg-b-10" id="add_hashtag">
                        <i class="icon-plus-circle"></i>
                    </span>
                </div><!-- row -->
                </div>

                <div class="row row-xs wd-xl-80p">
                    <div class="col-sm-6 col-md-3">
                        <!-- <button type="submit" value="Thêm danh mục" >Thêm danh mục</button> -->
                        <input type="submit" value="Thêm danh mục" name="insert" class="btn btn-main btn-block">
                    </div>
                </div>
            </form>

            <hr class="mg-y-30">

            

            <div class="ht-40"></div>

        </div><!-- sbs-content-body -->
    </div><!-- container -->
</div><!-- sbs-content -->