
<!-- vendor css -->
<link href=".system/lib/admin/spectrum-colorpicker/spectrum.css" rel="stylesheet">
<link href=".system/lib/admin/select2/css/select2.min.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
<link href=".system/lib/admin/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
<link href=".system/lib/admin/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
<link href=".system/lib/admin/pickerjs/picker.min.css" rel="stylesheet">

<script defer src=".public/js/admin/categories/delete.js"></script>
 
<div class="sbs-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
    
        <?php
            include_once 'menu.php';
        ?>

        <div class="sbs-content-body pd-lg-l-40 d-flex flex-column">
            <div class="sbs-content-breadcrumb">
                <span><a href="admin.php">Admin</a></span>
                <span><a href="admin.php?ctrl=categories">Danh mục</a></span>
                <span>
                    <?= (isset($parent) && $parent['id'] > 0) ? 'Xoá chi tiết: '.$parent['name'] : 'Xoá danh mục' ?>
                </span>
            </div>
            <h2 class="sbs-content-title">
                <?= (isset($parent) && $parent['id'] > 0) ? 'Xoá chi tiết danh mục' : 'Xoá danh mục' ?>
            </h2>
            <?= 
                (isset($parent) && $parent['id'] > 0)
                ?   '<div class="sbs-content-label mg-b-5">#'.$parent['id'].' - '.$parent['name'].'</div>
                    <p class="mg-b-15">'.$parent['date'].' - '.$parent['creator'].'</p>'
                :   '';
            ?>

            <div class="table-responsive">
                <form action="admin.php?ctrl=categories&act=delete" method="post" id="delete_category">
                    <table class="table table-striped mg-b-20" id="choices_table">

                    <?php
                        if(isset($parent) && $parent['id'] > 0)
                        {

                    ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Cập nhật lần cuối</th>
                                <th>Số sản phẩm</th>
                                <th>Trạng thái</th>
                                <th><i class="icon-check-3"></i></th>
                            </tr>
                        </thead>
                    <?php
                        $output = '';
                        foreach($childrens as $child)
                        {
                            $among = count_product($child['id']);
                            $status = ($among['among'] > 0)
                                        ? '<span><em><sub>Không khả dụng<sub></em></span>'
                                        : '<span class="hl-txt"><sub>Có thể xoá<sub></span>';
                            $checkbox = ($among['among'] > 0)
                                        ? '<a href="#" class="hl-hv">
                                            Hiện có sản phẩm
                                        </a>'
                                        : '<label class="ckbox">
                                            <input type="checkbox" name="choices[]" value="'.$child['id'].'"><span></span>
                                        </label>';
                            $output .=
                                '<tr>
                                    <th scope="row">'.$child['id'].'</th>
                                    <td>'.$child['name'].'</td>
                                    <td>'.$child['date'].' - '.$child['creator'].'</td>
                                    <td>'.$among['among'].'</td>
                                    <td>'.$status.'</td>
                                    <td>'.$checkbox.'</td>
                                </tr>';
                        }
                        echo $output;
                    ?>

                    <?php
                        }
                        else
                        {
                    ?>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Cập nhật lần cuối</th>
                                <th>Trạng thái</th>
                                <th><i class="icon-check-3"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                            $output = '';
                            foreach($getParent_categories as $parent)
                            {
                                $status = ($parent['width'] > 1)
                                            ? '<span><em><sub>Không khả dụng<sub></em></span>'
                                            : '<span class="hl-txt"><sub>Có thể xoá<sub></span>';
                                $checkbox = ($parent['width'] > 1)
                                            ? '<a href="admin.php?ctrl=categories&act=delete&id='.$parent['id'].'" class="hl-hv">
                                                Chi tiết
                                            </a>'
                                            : '<label class="ckbox">
                                                <input type="checkbox" name="choices[]" value="'.$parent['id'].'"><span></span>
                                            </label>';
                                $output .=
                                    '<tr>
                                        <td scope="row">'.$parent['id'].'</td>
                                        <td>'.$parent['name'].'</td>
                                        <td>'.$parent['date'].' - '.$parent['creator'].'</td>
                                        <td>'.$status.'</td>
                                        <td>'.$checkbox.'</td>
                                    </tr>';
                            }
                            echo $output;
                        }
                    ?>

                        </tbody>
                    </table>
                </form>
            </div><!-- table-responsive -->

            <div class="row row-xs wd-xl-80p">
                <div class="col-sm-6 col-md-3">
                    <input type="button" value="Xoá các mục đã chọn" name="delete" form="delete_category" class="btn btn-main btn-block" id="submit">
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="reset" value="Bỏ chọn tất cả" form="delete_category" class="btn btn-hl btn-block">Bỏ chọn tất cả</button>
                </div>
            </div>

            <hr class="mg-y-30">

            <div class="ht-40"></div>

        </div><!-- sbs-content-body -->
    </div><!-- container -->
</div><!-- sbs-content -->