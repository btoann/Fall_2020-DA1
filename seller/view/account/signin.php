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
				<form action="seller.php?ctrl=account&act=signin" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-33 bold-txt">
                        <span class="bside-txt">S</span><span class="gray-txt">B</span><span class="hl-txt">S</span><span class="bside-txt">'s Seller</span>
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="user" placeholder="Email / Số điện thoại" required error="Trường này là bắt buộc">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input">
						<input class="input100" type="password" name="pass" placeholder="Mật khẩu" required error="Trường này là bắt buộc">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<input type="submit" name="signin" value="Đăng nhập" class="login100-form-btn main-bg-i hl-bg-hv">
					</div>

					<div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							Quên
						</span>

						<a href="#" class="txt2 hl-txt-i hov1">
							Tài khoản / Mật khẩu?
						</a>
					</div>

					<div class="text-center">
						<span class="txt1">
							Chưa phải là cộng tác viên?
						</span>

						<a href="seller.php?ctrl=account&act=signup" class="txt2 hl-txt-i hov1">
							Đăng ký
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



<!-- <form >
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
</form> -->
