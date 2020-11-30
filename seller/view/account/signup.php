<form action="seller.php?ctrl=account&act=signup" method="post">
    <h1>Đăng ký</h1>
    <table>
        <tr>
            <th colspan="2" width="100%">
                <p>
                    Bạn đã là cộng tác viên của chúng tôi!&ensp;<a href="seller.php?ctrl=account&act=signin" class="yellow_content">Đăng nhập ngay</a>
                </p>
            </th>
        </tr>
        <tr>
            <td>
                <span>Gian hàng dành cho</span>
            </td>
            <td>
                <input type="radio" id="" name="role" value="10">
                <label for="personal">Cá nhân</label>
                &ensp;
                <input type="radio" id="" name="role" value="20">
                <label for="company">Doanh nghiệp</label>
            </td>
        </tr>
        <tr>
            <td>
                <span>Địa chỉ</span>
            </td>
            <td>
                <select name="address" id="address">
                    <option value="Việt Nam" selected>Việt Nam</option>
                    <option value="Khác">Khác</option>
                </select>
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
                <span>Tên gian hàng</span>
            </td>
            <td>
                <input type="text" name="name" id="name" value="" required placeholder error="Truờng này là bắt buộc"> 
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