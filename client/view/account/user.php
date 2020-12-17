
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
                        <li class="signin-active"><a class="btn" href="#">Kích hoạt tài khoản</a></li>
                    </ul>
                </div>

                <p class="logo-text">
                    <a href="index.php">
                        <span class="bside-txt">SIDE</span><span class="gray-txt between">by</span><span class="hl-txt">SIDE</span>
                    </a>
                </p>

                <div ng-app ng-init="checked = false">
                    <form action="index.php?ctrl=account&act=user&id=<?= $_SESSION['sbs_user']['id'] ?>" class="form-forgot"  method="post" name="form" autocomplete="off" id="forgotform">
                        
                        <p class="forgot-messenge gray-txt">
                            <label for="">Tài khoản chưa được kích hoạt</label>
                            <?= isset($_SESSION['sbs_user']['active_time_sent']) ? 'Kiểm tra hộp thư của bạn để nhận đường link kích hoạt của chúng tôi' : 'Gửi mã để kích hoạt tài khoản của bạn' ?><br>
                        <strong>*Lưu ý: </strong><em class="hl-txt">Mã kích hoạt chỉ tồn tại trong 5 phút kể từ lúc gửi mail</em></p>
                        <input type="submit" name="resend_verify" value="<?= isset($_SESSION['sbs_user']['active_time_sent']) ? 'Gửi lại mã kích hoạt' : 'Gửi mã kích hoạt' ?>" class="btn-signin main-bg hl-bg-hv lightgray-txt-i">
                        
                    </form>
            
                    <form class="form-signup">
                    </form>
                    <div class="success">
                    </div>
                </div>

            </div>
        </div>

<?php
        }
        if($_SESSION['sbs_user']['role'] > 0)
            echo
                '<h4>Tài khoản đã được kích hoạt</h4>';
    }

?>
