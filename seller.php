<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sbs_id']) && $_SESSION['sbs_id'] > 0)
    {
        if($_SESSION['sbs_role'] >= 20)
        {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebyside.seller</title>
</head>

    <h3>Trang người bán</h3>

    <?php
        if(isset($_SESSION['sbs_id']) && $_SESSION['sbs_id'] > 0)
        {
            if($_SESSION['sbs_role'] >= 30) 
                echo
                    '<a href="admin.php">[ admin: '.$_SESSION['sbs_name'].' ]</a>
                    &ensp;
                    <a href="index.php">[ Trang chủ ]</a>
                    &ensp;
                    <a href="index.php?ctrl=account&act=logout">[ Đăng xuất ]</a>';
            else
                echo
                    '<a href="seller.php?ctrl=account&act=user&id='.$_SESSION['sbs_id'].'">[ '.$_SESSION['sbs_name'].' ]</a>
                    &ensp;
                    <a href="index.php">[ Trang chủ ]</a>
                    &ensp;
                    <a href="index.php?ctrl=account&act=logout">[ Đăng xuất ]</a>';
        }
        else
        {
            echo
                '<a href="index.php?ctrl=account&act=signin">[ Đăng nhập ]</a>';
        }
    ?>
    
    <ul>
        <li><a href="seller.php?ctrl=products">QL sản phẩm</a></li>
        <li><a href="seller.php?ctrl=orders">QL đơn hàng</a></li>
        <li><a href="seller.php?ctrl=comments">Bình luận</a></li>
        <li><a href="seller.php?ctrl=statistics">Thống kê</a></li>
    </ul>
    
    <?php

        $index_file = 'seller/controller/home.php';
        if(isset($_GET['ctrl']) && $_GET['ctrl'])
        {
            $filename = 'seller/controller/'.$_GET['ctrl'].'.php';
            include (file_exists($filename)) ? $filename : $index_file;
        }
        else
            include $index_file;

    ?>

    </body>
</html>
<?php
        }
        else
        {
            header('location: seller.php?ctrl=account&act=signup');
        }
    }
    ob_end_flush();
?>