<form action="index.php?ctrl=account&act=forgot" method="post">
    <h2>Lấy lại mật khẩu</h2>
    <table>
        <tr>
            <td>
                <span>Email</span>
            </td>
            <td>
                <input type="email" name="email" id="email" value="" required placeholder error="Trường này là bắt buộc">
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input width="100%" type="submit" name="forgot" id="submit" value="Gửi mã">
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

    print_r($_SESSION['forgot_send']);
    echo '<br>';
    print_r(time());

?>