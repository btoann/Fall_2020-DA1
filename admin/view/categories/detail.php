
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
    <div class="sbs-content-left sbs-content-left-components">
        <div class="component-item">
        <label>UI Elements</label>
        <nav class="nav flex-column">
            <a href="elem-buttons.html" class="nav-link">Buttons</a>
            <a href="elem-dropdown.html" class="nav-link">Dropdown</a>
            <a href="elem-icons.html" class="nav-link">Icons</a>
        </nav>
        <label>Forms</label>
        <nav class="nav flex-column">
            <a href="form-elements.html" class="nav-link">Form Elements</a>
        </nav>
        <label>Charts</label>
        <nav class="nav flex-column">
            <a href="chart-chartjs.html" class="nav-link">ChartJS</a>
        </nav>

        <label>Tables</label>
        <nav class="nav flex-column">
            <a href="table-basic.html" class="nav-link active">Basic Tables</a>
        </nav>
        </div><!-- component-item -->

    </div><!-- sbs-content-left -->


    <div class="sbs-content-body pd-lg-l-40 d-flex flex-column">
        <div class="sbs-content-breadcrumb">
            <span><a href="admin.php">Admin</a></span>
            <span><a href="admin.php?ctrl=categories">Danh mục</a></span>
            <span><?= $parent['name'] ?></span>
        </div>
        <h2 class="sbs-content-title">Chi tiết danh mục</h2>
        <div class="sbs-content-label mg-b-5">#<?= $parent['id'] ?> - <?= $parent['name'] ?></div>
        <p class="mg-b-15"><?= $parent['creator'] ?> - <?= $parent['date'] ?></p>

        <div class="table-responsive">
        <table class="table table-striped mg-b-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Ngày thêm - Tác giả</th>
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

        <hr class="mg-y-30">

        

        <div class="ht-40"></div>

    </div><!-- sbs-content-body -->
    </div><!-- container -->
</div><!-- sbs-content -->