<!DOCTYPE html>
<html lang="en">

<head>
	<title>Seller's SBS login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=".public/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=".public/css/_style.css">
	<link rel="stylesheet" type="text/css" href=".public/css/seller/account.css">
	<link rel="stylesheet" type="text/css" href=".public/css/seller/account-main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="lightgray-bg-i container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form action="seller.php?ctrl=account&act=signup" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-33 bold-txt">
                        <span class="bside-txt">S</span><span class="gray-txt">B</span><span class="hl-txt">S</span><span class="bside-txt">'s Seller</span>
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" name="tel" pattern="[0-9]*" placeholder="Số điện thoại">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
                    </div>
                    
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="mart" placeholder="Tên gian hàng">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>
                    
					<div class="wrap-input100 rs1 validate-input">
						<input class="input100" type="password" name="pass" placeholder="Mật khẩu">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
                    </div>
                    
					<div class="wrap-input100 rs1 validate-input">
						<input class="input100" type="password" name="comfirm_pass" placeholder="Xác nhận mật khẩu">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
                    </div>

					<div class="wrap-input100 p-t-20 p-r-25 p-l-25 p-b-15">
						<span class="text-left txt1">
							Gian hàng
						</span>
                        &emsp;&emsp;&ensp;
                        <span class="bside-txt p-t-10">
                            <input type="radio" id="" name="role" value="10" id="personal" checked>
                            <label for="personal">Cá nhân</label>
                            &ensp;
                            <input type="radio" id="" name="role" value="20" id="company">
                            <label for="company">Doanh nghiệp</label>
                        </span>
					</div>

					<div class="wrap-input100 p-t-17 p-r-25 p-l-25 p-b-17">
						<span class="text-left txt1">
							Địa chỉ gian hàng
                        </span>
                        &emsp;&emsp;&emsp;&emsp;&emsp;
                        <select name="address" class="bside-txt p-t-5 p-r-10 p-l-10 p-b-5">
                            <option value="Việt Nam" selected>Việt Nam</option>
                            <option value="Trung Quốc">Trung Quốc</option>
                            <option value="Thái Lan">Thái Lan</option>
                            <option value="Khác">Khác</option>
                        </select>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<input type="submit" name="signup" value="Đăng ký" class="login100-form-btn main-bg-i hl-bg-hv">
					</div>

					<div class="text-center p-t-45">
						<span class="txt1">
                            Bạn đã là cộng tác viên của chúng tôi!
						</span>

						<a href="seller.php?ctrl=account&act=signin" class="txt2 hl-txt-i hov1">
							Đăng nhập ngay
						</a>
					</div>
				</form>
			</div>
		</div>
    </div>
    
	<!--===============================================================================================-->
	<script src=".public/js/jquery_3.5.1.min.js"></script>
	<script src=".public/js/bootstrap.min.js"></script>
	<script src=".public/js/seller/account.js"></script>

</body>

</html>

<!-- 
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
                <input type="number" name="tel" id="tel" value="" required  placeholder error="Trường này là bắt buộc">
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
</form> -->