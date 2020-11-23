<form action="index.php?ctrl=account&act=signup" method="post">
    <h1>Đăng ký</h1>
    <table>
        <tr>
            <th colspan="2" width="100%">
                <p>
                    Bạn đã có tài khoản!&ensp;<a href="index.php?ctrl=account&act=signin" class="yellow_content">Đăng nhập ngay</a>
                </p>
            </th>
        </tr>
        <tr>
            <td>
                <span>Họ tên</span>
            </td>
            <td>
                <input type="text" name="name" id="name" value="" required placeholder error="Truờng này là bắt buộc"> 
            </td>
        </tr>
        <tr>
            <td>
                <span>Email</span>
            </td>
            <td>
                <input type="email" name="email" id="email" value="" required placeholder error="Trường này là bắt buộc">
            </td>
        </tr>
        <tr>
            <td>
                <span>Số điện thoại</span>
            </td>
            <td>
                <input type="number" name="tel" id="tel" value="" required pattern="[0-9]*" placeholder error="Trường này là bắt buộc">
            </td>
        </tr>
        <tr>
            <td>
                <span>Mật khẩu</span>
            </td>
            <td>
                <input type="password" name="pass" id="pass" value="" required placeholder error="Trường này là bắt buộc">
            </td>
        </tr>
        <tr>
            <td>
                <span>Xác nhận Mật khẩu</span>
            </td>
            <td>
                <input type="password" name="confirm_pass" id="confirm_pass" required placeholder>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input width="100%" type="submit" name="signup" id="submit" value="Đăng ký">
            </th>
        </tr>
        <tr>
            <th colspan="2">
                <p id="warning"></p>
            </th>
        </tr>
    </table>
</form>