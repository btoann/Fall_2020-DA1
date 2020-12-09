
<!-- vendor css -->
<link href=".system/lib/admin/spectrum-colorpicker/spectrum.css" rel="stylesheet">
<link href=".system/lib/admin/select2/css/select2.min.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
<link href=".system/lib/admin/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
<link href=".system/lib/admin/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
<link href=".system/lib/admin/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
<link href=".system/lib/admin/pickerjs/picker.min.css" rel="stylesheet">

<script defer src=".public/js/admin/categories/update.js"></script>

<div class="sbs-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
    
        <?php
            include_once 'menu.php';
        ?>

        <div class="sbs-content-body pd-lg-l-40 d-flex flex-column">
            <div class="sbs-content-breadcrumb">
                <span><a href="admin.php">Admin</a></span>
                <span><a href="admin.php?ctrl=categories">Danh mục</a></span>
                <span>Cập nhật: <?= $parent['name'] ?></span>
            </div>
            <h2 class="sbs-content-title">Cập nhật danh mục</h2>
            
            <div class="row row-xs wd-xl-80p">
                <div class="col-sm-6 col-md-2">
                    <input class="form-control" placeholder="Tên danh mục" name="id" form="update_categories" readonly required type="text" value="<?= $parent['id'] ?>">
                </div>
                <div class="col-sm-6 col-md-5">
                    <input class="form-control" placeholder="Tên danh mục" name="name" form="update_categories" required type="text" value="<?= $parent['name'] ?>">
                </div>
                <div class="col-sm-6 col-md-5">
                    <table class="sbs-table-reference mg-t-0">
                        <tbody>
                            <tr>
                                <td class="pt-1 pb-1">
                                    <div class="sbs-toggle-group-demo mg-t-1 mg-b-1">
                                        <strong class="mg-t-3">Trạng thái </strong>
                                        &emsp;
                                        <div class="sbs-toggle sbs-toggle-success <?= ($parent['active'] > 1) ? 'on' : '' ?>"><span></span></div>  
                                        <input name="active" form="update_categories" required type="hidden" value="<?= $parent['active'] ?>">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <p class="mg-t-10 mg-b-2"><strong>Cập nhật: &ensp;</strong><?= $parent['date'] ?></p>
            <p class="mg-t-0 mg-b-15"><strong>Chỉnh sửa:&ensp;</strong><?= $parent['creator'] ?></p>

            <div class="table-responsive">
                <form class="" action="admin.php?ctrl=categories&act=delete" method="post" id="update_categories">
                    <table class="table table-striped mg-b-20">
                        <thead>
                            <tr>
                                <th width="15%">#</th>
                                <th>Tên</th>
                                <th>Cập nhật lần cuối</th>
                                <th>Danh mục cha</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                            $parents = '';
                            foreach($getParent_categories as $parent_op)
                            {
                                $selected = ($parent_op['id'] == $parent['id']) ? 'selected' : '';
                                $parents .= '<option value="'.$parent_op['id'].'" '.$selected.'>'.$parent_op['name'].'</option>';
                            }

                            $output = '';
                            foreach($childrens as $child)
                            {
                                $among = count_product($child['id']);
                                $active = ($child['active'] > 1) ? 'on' : '';
                                $output .=
                                    '<tr>
                                        <th scope="row">
                                            <input class="form-control" placeholder="Tên danh mục" name="ids[]" readonly required type="text" value="'.$child['id'].'">
                                        </th>
                                        <td>
                                            <input class="form-control" placeholder="Tên danh mục" name="names[]" required type="text" value="'.$child['name'].'">
                                        </td>
                                        <td><div class="mg-t-10">'.$child['date'].' - '.$child['creator'].'</div></td>
                                        <td>
                                            <select class="form-control select2" name="parents[]" id="parent_category">
                                                '.$parents.'
                                            </select>
                                        </td>
                                        <td>
                                            <div class="sbs-toggle sbs-toggle-success mg-t-6 mg-l-3 '.$active.'"><span></span></div>  
                                            <input name="actives[]" form="update_categories" required type="hidden" value="'.$child['active'].'">
                                        </td>
                                    </tr>';
                            }
                            echo $output;

                        ?>

                        </tbody>
                    </table>
                </form>
            </div><!-- table-responsive -->

            <div class="row row-xs wd-xl-80p">
                <div class="col-sm-6 col-md-3">
                    <input type="button" value="Cập nhật danh mục" name="delete" form="update_categories" class="btn btn-main btn-block" id="submit">
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="reset" value="Dữ liệu gốc" form="update_categories" class="btn btn-hl btn-block">Dữ liệu gốc</button>
                </div>
            </div>

            <hr class="mg-y-30">

            <div class="ht-40"></div>

        </div><!-- sbs-content-body -->
    </div><!-- container -->
</div><!-- sbs-content -->