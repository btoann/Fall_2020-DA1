
<!-- vendor css -->
<link href=".system/lib/admin/spectrum-colorpicker/spectrum.css" rel="stylesheet">
<link href=".system/lib/admin/select2/css/select2.min.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
<link href=".system/lib/admin/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
<link href=".system/lib/admin/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
<link href=".system/lib/admin/pickerjs/picker.min.css" rel="stylesheet">

<div class="sbs-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
    
        <?php
            include_once 'menu.php';
        ?>

        <div class="sbs-content-body pd-lg-l-40 d-flex flex-column">
            <div class="sbs-content-breadcrumb">
                <span><a href="admin.php">Admin</a></span>
                <span><a href="admin.php?ctrl=categories">Danh mục</a></span>
                <span><?= $parent['name'] ?></span>
            </div>
            <h2 class="sbs-content-title">Chi tiết danh mục</h2>
            <div class="sbs-content-label mg-b-5">#<?= $parent['id'] ?> - <?= $parent['name'] ?></div>
            <p class="mg-b-15"><?= $parent['date'] ?> - <?= $parent['creator'] ?></p>

            <div class="table-responsive">
                <table class="table table-striped mg-b-20">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Cập nhật lần cuối</th>
                            <th>Số sản phẩm</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                        $output = '';
                        foreach($childrens as $child)
                        {
                            $among = count_product($child['id']);
                            $output .=
                                '<tr>
                                    <th scope="row">'.$child['id'].'</th>
                                    <td>'.$child['name'].'</td>
                                    <td>'.$child['date'].' - '.$child['creator'].'</td>
                                    <td>'.$among['among'].'</td>
                                </tr>';
                        }
                        echo $output;

                    ?>

                    </tbody>
                </table>
            </div><!-- table-responsive -->

            <div class="row row-xs wd-xl-80p">
                <div class="col-sm-6 col-md-3">
                    <a href="admin.php?ctrl=categories&act=update&id=<?= $parent['id'] ?>" class="btn btn-main btn-block">
                        Cập nhật danh mục
                    </a>
                </div>
            </div>

            <hr class="mg-y-30">

            

            <div class="ht-40"></div>

        </div><!-- sbs-content-body -->
    </div><!-- container -->
</div><!-- sbs-content -->