<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebyside.shop</title>
    <script src=".public/js/jquery_3.5.1.js" defer></script>
</head>
<body>
    
    <h3>Trang chủ</h3>
    
    <?php
        if(isset($_SESSION['sbs_id']) && $_SESSION['sbs_id'] > 0)
        {
            if($_SESSION['sbs_role'] >= 30) 
                echo
                    '<a href="admin.php">[ admin: '.$_SESSION['sbs_name'].' ]</a>
                    &ensp;
                    <a href="seller.php">[ Trang người bán ]</a>
                    &ensp;
                    <a href="index.php?ctrl=account&act=logout">[ Đăng xuất ]</a>';
            else
                echo
                    '<a href="index.php?ctrl=account&act=user&id='.$_SESSION['sbs_id'].'">[ '.$_SESSION['sbs_name'].' ]</a>
                    &ensp;
                    <a href="seller.php">[ Trang người bán ]</a>
                    &ensp;
                    <a href="index.php?ctrl=account&act=logout">[ Đăng xuất ]</a>';
        }
        else
        {
            echo
                '<a href="index.php?ctrl=account&act=signin">[ Đăng nhập ]</a>';
        }
    ?>

    <?php

        $index_file = 'client/controller/home.php';
        if(isset($_GET['ctrl']) && $_GET['ctrl'])
        {
            $filename = 'client/controller/'.$_GET['ctrl'].'.php';
            include (file_exists($filename)) ? $filename : $index_file;
        }
        else
            include $index_file;

    ?>

</body>
</html>

<?php
    ob_end_flush();
?>