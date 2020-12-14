<!DOCTYPE html>

<html>
    <head>
        <title>Đăng xuất tài khoản</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
    </head>
    <body>

        <?php
        session_start();
        unset($_SESSION['current_user']);
        unset($_SESSION['access_token']);
        ?>      
        <script>
        alert('Đăng xuất tài khoản thành công');
        </script>

            <div class="form-lg">
                <div class="wcome">
                    <div class="cover_photo">
                        <img src="#" alt="">
                    </div>
                    <div class="profile-photo"> </div>
                    <h1 class="hi_ad"> CHÀO MỪNG  </h1>
                    <a class="btn-back" href="./login.php">Đăng nhập lại </a>
            </div>
        </div>
    </body>
</html>
