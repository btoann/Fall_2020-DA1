<?php
    if($sent == false)
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

        <?= (!isset($_SESSION['forgot_send']))
            ? '<a type="reset" id="refresh" value="Refresh" onclick="document.getElementById(\'forgotform\').reset()">
                    <svg class="refreshicon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 322.447 322.447" style="enable-background:new 0 0 322.447 322.447;" xml:space="preserve">
                        <path d="M321.832,230.327c-2.133-6.565-9.184-10.154-15.75-8.025l-16.254,5.281C299.785,206.991,305,184.347,305,161.224
                                    c0-84.089-68.41-152.5-152.5-152.5C68.411,8.724,0,77.135,0,161.224s68.411,152.5,152.5,152.5c6.903,0,12.5-5.597,12.5-12.5
                                    c0-6.902-5.597-12.5-12.5-12.5c-70.304,0-127.5-57.195-127.5-127.5c0-70.304,57.196-127.5,127.5-127.5
                                    c70.305,0,127.5,57.196,127.5,127.5c0,19.372-4.371,38.337-12.723,55.568l-5.553-17.096c-2.133-6.564-9.186-10.156-15.75-8.025
                                    c-6.566,2.134-10.16,9.186-8.027,15.751l14.74,45.368c1.715,5.283,6.615,8.642,11.885,8.642c1.279,0,2.582-0.198,3.865-0.614
                                    l45.369-14.738C320.371,243.946,323.965,236.895,321.832,230.327z" />
                    </svg>
                </a>'
            : '' ?>
    </div>

<?php
    }
    else
    {
?>
    <div id="user_login" class="container">
        <div class="frame frame-resetpass">
            <div class="nav">
                <ul class="links">
                    <li class="signin-active"><a class="btn" href="#">Đặt lại mật khẩu</a></li> 
                </ul>
            </div>

            <p class="logo-text">
                <a href="index.php">
                    <span class="bside-txt">SIDE</span><span class="gray-txt between">by</span><span class="hl-txt">SIDE</span>
                </a>
            </p>

            <div ng-app ng-init="checked = false">
                <form action="index.php?ctrl=account&act=forgot&code=<?= $_GET['code'] ?>" class="form-signin" method="post" name="form" autocomplete="off" id="resetform">
                    <label for="email">Email</label>
                    <input class="form-styling" type="text" name="email" id="email" placeholder="" required value="<?= $_SESSION['forgot_send']['email'] ?>" readonly>
                    <label for="pass">Mật khẩu mới</label>
                    <input class="form-styling" type="password" name="pass" id="pass" placeholder="" required>
                    <label for="confirm_pass">Xác nhận mật khẩu mới</label>
                    <input class="form-styling" type="password" name="confirm_pass" id="confirm_pass" placeholder="" required>
                    <br>
                    <input type="checkbox" id="checkbox" name="signin">
                    <label for="checkbox" class="bside-txt-i"><span class="ui upc-txt"></span><p class="m-t-2-i">Đăng nhập</p></label>
                    <input width="100%" type="submit" name="reset" value="Xác nhận" class="btn-signin main-bg hl-bg-hv lightgray-txt-i">
                </form>
        
                <form class="form-signup">
                </form>
                <div class="success">
                </div>
            </div>

        </div>

        <a type="reset" id="refresh" value="Refresh" onclick="document.getElementById('resetform').reset()">
            <svg class="refreshicon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 322.447 322.447" style="enable-background:new 0 0 322.447 322.447;" xml:space="preserve">
                <path d="M321.832,230.327c-2.133-6.565-9.184-10.154-15.75-8.025l-16.254,5.281C299.785,206.991,305,184.347,305,161.224
                            c0-84.089-68.41-152.5-152.5-152.5C68.411,8.724,0,77.135,0,161.224s68.411,152.5,152.5,152.5c6.903,0,12.5-5.597,12.5-12.5
                            c0-6.902-5.597-12.5-12.5-12.5c-70.304,0-127.5-57.195-127.5-127.5c0-70.304,57.196-127.5,127.5-127.5
                            c70.305,0,127.5,57.196,127.5,127.5c0,19.372-4.371,38.337-12.723,55.568l-5.553-17.096c-2.133-6.564-9.186-10.156-15.75-8.025
                            c-6.566,2.134-10.16,9.186-8.027,15.751l14.74,45.368c1.715,5.283,6.615,8.642,11.885,8.642c1.279,0,2.582-0.198,3.865-0.614
                            l45.369-14.738C320.371,243.946,323.965,236.895,321.832,230.327z" />
            </svg>
        </a>
    </div>

<?php
    }

    // if(isset($_SESSION['forgot_send']))
    //     print_r($_SESSION['forgot_send']);
    // echo '<br>';
    //print_r(time());

?>