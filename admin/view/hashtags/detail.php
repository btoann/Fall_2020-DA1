
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
            include_once 'admin/view/categories/menu.php';
        ?>

        <div class="sbs-content-body pd-lg-l-40 d-flex flex-column">
            <div class="sbs-content-breadcrumb">
                <span><a href="admin.php">Admin</a></span>
                <span><a href="admin.php?ctrl=hashtags">Phân loại danh mục</a></span>
                <span><?= $parent['name'] ?></span>
            </div>
            <h2 class="sbs-content-title mg-b-5">Phân loại: <?= $parent['name'] ?></h2>
            <p class="mg-b-40">
                <?= 
                    ($parent['active'] > 1) ? '<span class="tx-success"><em>Hoạt động</em></span>' : '<span class="hl-txt"><em>Tạm ẩn</em></span>'
                ?>
            </p>
            
            <?php

                $output = '';
                foreach($childrens as $child)
                {
                    $active = ($child['active'] > 1)
                            ? '<span class="tx-success"><em>Hoạt động</em></span>' : '<span class="hl-txt"><em>Tạm ẩn</em></span>';
                    $output .=
                        '<div class="sbs-content-label mg-b-5">#'.$child['id'].' - '.$child['name'].'</div>
                        <p class="mg-b-15">'.$active.'</p>';

                    $hashtags = '';
                    $get_hashtags = get_hashtags($child['id']);
                    if($get_hashtags != NULL)
                        foreach($get_hashtags as $hashtag)
                        {
                            $hashtags .=
                                '<div class="col-lg-3 mg-b-10">
                                    <input class="form-control" placeholder="#hashtag" type="text" name="" value="'.$hashtag['name'].'" readonly>
                                </div>';
                        }
                    else
                        $hashtags .=
                                '<div class="col-lg-3 mg-b-10">
                                    <p><em>Không tồn tại phân loại</em></p>
                                </div>';
                    $output .=
                        '<div class="row row-sm">
                            '.$hashtags.'
                        </div>
                        <div class="row row-xs wd-xl-80p mg-t-10 mg-b-40">
                            <div class="col-sm-6 col-md-4">
                                <a href="admin.php?ctrl=hashtags&act=manage&id='.$child['id'].'" class="btn btn-main btn-block">
                                    Cập nhật phân loại danh mục
                                </a>
                            </div>
                        </div>';
                }
                echo $output;

            ?>


            <hr class="mg-y-30">

            

            <div class="ht-40"></div>

        </div><!-- sbs-content-body -->
    </div><!-- container -->
</div><!-- sbs-content -->