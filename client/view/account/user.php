
<?php

    if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
    {
        if($_SESSION['sbs_user']['role'] == 0)
            echo
                '<h4>Tài khoản chưa được kích hoạt</h4>
                <p>Kiểm tra hộp thư của bạn để nhận đường link xác nhận của chúng tôi</p>
                
                <form action="index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id'].'" method="post">
                    <input type="submit" value="Gửi lại mã" name="resend_verify">
                    <span>Nếu bạn cần một mã xác thực mới</span>
                </form>';
        if($_SESSION['sbs_user']['role'] > 0)
            echo
                '<h4>Tài khoản đã được kích hoạt</h4>';
    }

?>
