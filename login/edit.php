<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="login.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
</head>

    <body>
        <?php
        include './connect_db.php';
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])
            ) {
                $userResult = mysqli_query($con, "Select * from `user` WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
                if ($userResult->num_rows > 0) {
                    $result = mysqli_query($con, "UPDATE `user` SET `password` = MD5('" . $_POST['new_password'] . "'), `last_updated`=" . time() . " WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
                    if (!$result) {
                        $error = "Không thể cập nhật tài khoản";
                    }
                } else {
                    $error = "Mật khẩu cũ không đúng.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="./edit.php">Đổi lại mật khẩu</a>
                    </div>
                <?php } else { ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
                        <a href="./login.php">Quay lại tài khoản</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="edit-notify" class="box-content">
                    <h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
                    <a href="./edit.php">Quay lại sửa tài khoản</a>
                </div>
                <?php
            }
        } else {
            session_start();
            // $user = $_SESSION['current_user'];
            if (!empty($user)) {
                ?>

<div id="edit_user" class="container">
        <div class="frame">
            <div style="height: 150px" class="nav">
                <ul class="links">
                    <li class="signin-active"><a class="btn">Đổi mật khẩu</a></li>
                </ul>
                <div class="box_logo"><img src="images/logo.png" alt=""></div>
            </div>
         
            <form style="margin-left: 40px" action="./edit.php?action=edit" method="Post" autocomplete="off">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <label for="username">Mật khẩu cũ</label>
                    <input style="width: 90%;" class="form-styling" type="password" name="old_password" >
                    <label for="password">Mật khẩu mới</label>   
                    <input style="width: 90%" class="form-styling" type="password" name="new_password">            
                    <input type="checkbox" id="checkbox" />
                    <a class="btn-animate" style="width:90%" value="Refresh" onClick="window.history.back()">Trở lại</a>
                    <div style="width: 90%" class="btn-animate">
                        <a type="submit" class="btn-signin">Cập nhập</a>
                    </div>
                  
                    </form>
            </div>
        </div>

                <?php
            }
        }
        ?>

    </body>
</html>
