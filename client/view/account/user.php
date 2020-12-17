
<?php

    if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
    {
        if($_SESSION['sbs_user']['role'] == 0)
        {
?>

        <div id="user_login" class="container">
            <div class="frame frame-forgot-<?= (!isset($_SESSION['forgot_send'])) ? '1' : '2' ?>" class="btn-signin main-bg hl-bg-hv lightgray-txt-i">
                <div class="nav">
                    <ul class="links">                   
                        <li class="signin-active"><a class="btn" href="#">Lấy lại mật khẩu</a></li>
                    </ul>
                </div>

                <p class="logo-text">
                    <a href="index.php">
                        <span class="bside-txt">SIDE</span><span class="gray-txt between">by</span><span class="hl-txt">SIDE</span>
                    </a>
                </p>

                <div ng-app ng-init="checked = false">
                    <form action="index.php?ctrl=account&act=forgot" class="form-forgot <?= (isset($_SESSION['forgot_send'])) ? 'form-forgot-2' : '' ?>"  method="post" name="form" autocomplete="off" id="forgotform">
                        <label for="email">Email của tài khoản cần lấy lại mật khẩu</label>
                        <input class="form-styling" type="text" name="email" id="email" placeholder="" required 
                            <?= (isset($_SESSION['forgot_send'])) ? 'value="'.$_SESSION['forgot_send']['email'].'" readonly' : '' ?>>
                        <?= (isset($_SESSION['forgot_send']))
                            ? '<label><a href="index.php?ctrl=account&act=forgot&new=true" class="bside-txt hl-hv">Tài khoản khác</a></label>'
                            : '' ?>
                        <input type="submit" name="forgot" value="<?= (!isset($_SESSION['forgot_send'])) ? 'Gửi mã xác nhận' : 'Gửi lại mã xác nhận' ?>" class="btn-signin main-bg hl-bg-hv lightgray-txt-i">
                        
                        <?= (isset($_SESSION['forgot_send']))
                            ? '<p class="forgot-messenge gray-txt">Kiểm tra hộp thư của bạn và chắc chắn rằng bạn nhận được thư của chúng tôi<br>
                                <strong>*Lưu ý:</strong> <em class="hl-txt">Mã xác nhận chỉ có hiệu lực trên trình duyệt bạn đã tiến hành gửi mã</em></p>'
                            : '' ?>
                    </form>
            
                    <form class="form-signup">
                    </form>
                    <div class="success">
                    </div>
                </div>

                <div class="forgot">
                    <a href="index.php?ctrl=account&act=signin" class="bside-txt hl-hv">Trở về đăng nhập</a>
                </div>

            </div>
        </div>

<?php
            echo
                '<h4>Tài khoản chưa được kích hoạt</h4>
                <p>Kiểm tra hộp thư của bạn để nhận đường link xác nhận của chúng tôi</p>
                
                <form action="index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id'].'" method="post">
                    <input type="submit" value="Gửi lại mã" name="resend_verify">
                    <span>Nếu bạn cần một mã xác thực mới</span>
                </form>';
        }
        if($_SESSION['sbs_user']['role'] > 0)
            echo
                '<h4>Tài khoản đã được kích hoạt</h4>';
    }

?>
