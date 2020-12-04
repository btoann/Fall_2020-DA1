<form action="seller.php?ctrl=account&act=signin" method="post">
    <h1>Đăng nhập</h1>
    <table>
        <tr>
            <th colspan="2" width="100%">
                <p>
                    Muốn trở thành cộng tác viên bán hàng?&ensp;<a href="seller.php?ctrl=account&act=signup">Đăng ký ngay</a>
                </p>
            </th>
        </tr>
        <tr>
            <td>
                <span>Email/ Số điện thoại</span>
            </td>
            <td>
                <input type="text" name="user" id="user" required placeholder>
            </td>
        </tr>
        <tr>
            <td>
                <span>Mật khẩu</span>
            </td>
            <td>
                <input type="password" name="pass" id="pass" required placeholder>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="#">Quên mật khẩu?</a>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input width="100%" type="submit" name="signin" value="Đăng nhập">
            </th>
        </tr>
        <tr>
            <th colspan="2">
                <p id="warning"></p>
            </th>
        </tr>
    </table>
</form>
