<?php
    if($sent == false)
    {
?>
    <form action="index.php?ctrl=account&act=forgot" method="post">
        <h2>Lấy lại mật khẩu</h2>
        <table>
            <tr>
                <td>
                    <span>Email</span>
                </td>
                <td>
                    <?= (!isset($_SESSION['forgot_send']))
                        ? '<input type="email" name="email" id="email" value="" required>'
                        : '<input type="email" name="email" id="email" value="'.$_SESSION['forgot_send']['email'].'" required readonly>'
                    ?>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <input width="100%" type="submit" name="forgot" id="forgot" value="<?= (!isset($_SESSION['forgot_send'])) ? 'Gửi mã' : 'Gửi lại mã' ?>">
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <p id="warning"><?= (!isset($_SESSION['forgot_send'])) ? '' : 'Mã đã được gửi, hết hiệu lực sau 5 phút' ?></p>
                </th>
            </tr>
        </table>
    </form>

<?php
    }
    else
    {
?>
    <form action="index.php?ctrl=account&act=forgot&code=<?= $_GET['code'] ?>" method="post">
        <h2>Đặt lại mật khẩu</h2>
        <table>
            <tr>
                <td>
                    <label for="pass">Mật khẩu mới</label>
                </td>
                <td>
                    <input class="form-styling" type="password" name="pass" id="pass" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="confirm_pass">Xác nhận mật khẩu</label>
                </td>
                <td>
                    <input class="form-styling" type="password" name="confirm_pass" id="confirm_pass" required>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <input width="100%" type="submit" name="reset" id="reset" value="Xác nhận">
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <p id="warning"></p>
                </th>
            </tr>
        </table>
    </form>

<?php
    }

    if(isset($_SESSION['forgot_send']))
        print_r($_SESSION['forgot_send']);
    echo '<br>';
    print_r(time());

?>