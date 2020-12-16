<?php
header('Content-type: text/html; charset=utf-8');

$config = file_get_contents('../config.json');
$array = json_decode($config, true);

include "../common/helper.php";


$endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";


$partnerCode = $array["partnerCode"];
$accessKey = $array["accessKey"];
$secretKey = $array["secretKey"];
$orderInfo = "Thanh toán qua MoMo";
// $amount = "10000";
$orderId = time() ."";
$returnUrl = "http://localhost/fall2020/testpayment/php/PayMoMo/result.php";
$notifyurl = "http://localhost/fall2020/testpayment/php/PayMoMo/ipn_momo.php";
// Lưu ý: link notifyUrl không phải là dạng localhost
$extraData = "merchantName=MoMo Partner";


if (!empty($_POST)) {
    $partnerCode = "MOMOPOZ120201210";
    // $_POST["partnerCode"];
    $accessKey = "NCErB8fWXqimCGRq";
    // $_POST["accessKey"];
    $serectkey = "zn2H8PwvAYWUkpvkwGpBrjI3sDMq2sM3";
    // $_POST["secretKey"];
    $orderId = $_POST["orderId"]; // Mã đơn hàng
    $orderInfo = "Thanh toán qua MoMo";
    // $_POST["orderInfo"];
    $amount = $_POST["amount"];
    $notifyurl = "http://localhost/fall2020/testpayment/php/PayMoMo/ipn_momo.php";
    // $_POST["notifyUrl"];
    $returnUrl = "http://localhost/fall2020/testpayment/php/PayMoMo/result.php";
    // $_POST["returnUrl"];
    $extraData = $_POST["extraData"];

    $requestId = time() . "";
    $requestType = "captureMoMoWallet";
    $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //before sign HMAC SHA256 signature
    $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
    $signature = hash_hmac("sha256", $rawHash, $serectkey);
    $data = array('partnerCode' => $partnerCode,
        'accessKey' => $accessKey,
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'returnUrl' => $returnUrl,
        'notifyUrl' => $notifyurl,
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json

    //Just a example, please check more in there

    header('Location: ' . $jsonResult['payUrl']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MoMo Sandbox</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="./statics/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="../../../css/client/css-fix/style.css" />
    <link rel="stylesheet" href="../../../icons/css/fontello.css" />
    <script src="https://kit.fontawesome.com/978d2e326d.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="./statics/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="./statics/moment/min/moment.min.js"></script>
<script type="text/javascript" src="./statics/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="./statics/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="./statics/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"/>
</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <a href="./index-fix.html"><img src="../../../images/logo.png" alt="" /></a>
            </div>
            <div class="menu">
                <div class="menu-top">
                    <div class="menu-top-list">
                        <ul>
                            <li><a href="#" class="a">Bán hàng cùng SBS</a></li>
                            <li><a href="#" class="a">Chăm sóc khách hàng</a></li>
                            <li><a href="#" class="a">Kiểm tra đơn hàng</a></li>
                            <li><a href="#" class="a">Chế độ tối</a></li>
                            <li><a href="#" class="a">Thay đổi ngôn ngữ</a></li>
                        </ul>
                    </div>
                    <div class="menu-top-login">
                        <p><a href="#">Đăng Nhập</a> <i class="icon-user-2"></i></p>
                    </div>
                </div>
                <div class="menu-bottom">
                    <div class="menu-bottom-category">
                        <p>
                            <a href="#" class="a1"><i class="icon-list-nested"></i> Danh mục</a
                >
              </p>
              <div class="hover">
                <div class="category">
                  <div class="category-hover">
                    <ul class="block-1">
                      <li>
                        <strong> Thiết bị di động</strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Điện tử - Điện lạnh </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Phụ kiện - Thiết bị số </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Laptop - Thiết bị IT </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Điện gia dụng </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Tiêu dùng - Thực phẩm </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Mẹ và bé </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Thời trang - Phụ kiện </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Phụ nữ - Làm đẹp </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Học tập </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Thể thao - Dã ngoại </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Y tế - Sức khỏe </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Giao thông - di chuyển </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Truyền thông - Giải trí </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Voucher - Dịch vụ </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="menu-bottom-search">
              <div class="menu-bottom-search-in">
                <input
                  type="text"
                  placeholder="Tìm kiếm sản phẩm, danh mục, đại lý..."
                /><a href="#"><i class="fas fa-search"></i></a>
                            <hr />
                    </div>
                </div>
                <div class="menu-bottom-cart">
                    <i class="fas fa-shopping-cart"></i
              ><span class="shopping-number">0</span>
            </div>
          </div>
        </div>
      </div>
      <div class="container-px-0">
        <div class="cart">
          GIỎ HÀNG<span class="counting">(1 sản phẩm)</span>
        </div>
        <div class="content-pay">
          <div class="seperate-left">
            <div class="product-trading">
              <a href="#">
                Side by Side Trading <i class="fas fa-angle-right"></i
              ></a>
            </div>
            <div class="information-product">
              <div class="image-product">
                <img src="../../../images/1.jpg" alt="" />
              </div>
              <div class="detail-product">
                <div class="detail-product-top">
                  <div class="detail-product-left">
                    <a class="item" href="#">
                      <span class="img"
                        ><img src="../../../images/logo.png" alt="" /></span
                      >Tai Nghe Nhét Tai Mi Basic Xiaomi HSEJ03JY - Hàng Chính
                      Hãng</a
                    >
                    <div class="word2">
                      <p class="ship-quickly">Hàng Giao 2H</p>
                    </div>
                    <div class="word2">
                      <span class="del">Xóa</span
                      ><span class="for-after">Để dành mùa sau</span>
                    </div>
                  </div>
                  <div class="detail-product-right">
                    <div class="price-item">
                      <h4>2.850.000</h4>
                      <h6><del>3.690.000</del> -23%</h6>
                    </div>
                    <div class="number">
                      <div class="CartQty__StyledCartQty-o1bx97-0 iaIXXn">
                        <span class="qty-decrease qty-disable">-</span
                        ><input type="tel" class="qty-input" value="1" /><span
                          class="qty-increase"
                          >+</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="seperate-right">
          <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                          action="init_payment.php">
            <div class="detail-product-bottom-item">
              <div class="word5">

              <!-- <input type='text' name="partnerCode" value="<?php echo $partnerCode; ?>" class="form-control"/>

              <input type='text' name="accessKey" value="<?php echo $accessKey;?>"  class="form-control"/> -->

              <input type='text' name="secretKey" value="<?php echo $secretKey; ?>"  class="form-control"/>

              <input type='text' name="orderId" value="<?php echo $orderId; ?>"  class="form-control"/>

              <input type='text' type="text" name="extraData" value="<?php echo $extraData?>"    class="form-control"/>

              <input type='text' name="orderInfo" value="<?php echo $orderInfo; ?>"  class="form-control"/>

              <input type='text' name="amount" value="<?php echo $amount; ?>" class="form-control"/>

              <input type='text' name="notifyUrl" value="<?php echo $notifyurl; ?>"  class="form-control"/>

              <input type='text' name="returnUrl" value="<?php echo $returnUrl; ?>" class="form-control"/>

                <div class="word-item"><strong>Địa chỉ nhận hàng</strong></div>
                <div class="change"><a href="#">Thay đổi</a></div>
              </div>
              <div class="word"><p>Lê Hữu Quân / 0123456789</p></div>
              <div class="word1">
                <p>1/19 Cu Chinh Lan, Phường 13, Quận Tân Bình, Hồ Chí Minh</p>
              </div>
            </div>
            <div class="detail-product-bottom-item">
              <div class="word5">
                <div></div>
                <span class="word-item">Mã Khuyến Mãi</span>
                <span class="change"
                  >Có thể chọn 2<span
                    ><img
                      class="icon"
                      src="https://frontend.tikicdn.com/_desktop-next/static/img/mycoupon/icons-info-gray.svg"
                      alt="info"
                    /> </span
                ></span>
              </div>
              <div class="word3">
                <p>
                  <a href="#"
                    ><span
                      ><img
                        src="https://frontend.tikicdn.com/_desktop-next/static/img/mycoupon/coupon_icon.svg"
                    /></span>
                    Chọn hoặc nhập khuyễn mãi</a
                  >
                </p>
              </div>
            </div>
            <div class="detail-product-bottom-item">
              <div class="word5">
                <div class="word-item">Tạm Tính</div>
                <div class="change">2.850.000đ</div>
              </div>
              <hr />
              <div class="word5">
                <div class="word-item">Thành Tiền</div>
                <div class="change" > <input type="text" name="amount" value=""></div>
              </div>
              <div class="note">
                <span class="note-item">(Đã bao gồm thuế VAT nếu có)</span>
              </div>
            </div>
            <button type="submit" class="bought btn btn-primary btn-block">Tiến hành đặt hàng</button>
                      <p>
                        <div style="margin-top: 1em;">
                            <button type="submit" class="btn btn-primary btn-block">Start MoMo payment....</button>
                        </div>
                        </p>
                </form>
          </div>
        </div>
        <div
          class="Container-itwfbd-0 jFkAwY"
          style="height: 100px; padding-top: 32px"
        >
          <div class="NewsLetter-icon">
            <img
              src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/newsletter.png"
              width="163"
              alt=""
            />
          </div>
          <div class="NewsLetter-description">
            <h3>Đăng ký nhận bản tin Side by Side</h3>
            <h5>Đừng bỏ lỡ hàng ngàn sản phẩm và chương trình siêu hấp dẫn</h5>
          </div>
          <div class="NewsLetter-form">
            <div>
              <input
                type="email"
                placeholder="Địa chỉ email của bạn"
                value=""
              />
            </div>
            <button>Đăng ký</button>
          </div>

          </div>
        <div class="Footer__Information-e3clg6-3 dZezzK">
          <div
            class="Container-itwfbd-0 jFkAwY"
            style="display: flex; justify-content: space-between"
          >
            <div class="block" style="width: 268px">
              <h4>HỖ TRỢ KHÁCH HÀNG</h4>
              <p class="hotline">
                Hotline chăm sóc khách hàng:
                <a href="tel:1900-6035">1900-6035</a
                ><span class="small-text"
                  >(1000đ/phút , 8-21h kể cả T7, CN)</span
                >
              </p>
              <a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi"
                class="small-text"
                target="_blank"
                >Các câu hỏi thường gặp</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/requests/new"
                class="small-text"
                target="_blank"
                >Gửi yêu cầu hỗ trợ</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/categories/200126644"
                class="small-text"
                target="_blank"
                >Hướng dẫn đặt hàng</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/categories/200123960"
                class="small-text"
                target="_blank"
                >Phương thức vận chuyển</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/doi-tra-de-dang"
                class="small-text"
                target="_blank"
                >Chính sách đổi trả</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/chuong-trinh/dieu-kien-tra-gop"
                class="small-text"
                target="_blank"
                >Hướng dẫn trả góp</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/articles/360000822643"
                class="small-text"
                target="_blank"
                >Chính sách hàng nhập khẩu</a
              >
              <p class="security">
                Hỗ trợ khách hàng:
                <a href="mailto:hotro@tiki.vn">hotro@sidebyside.vn</a>
              </p>
              <p class="security">
                Báo lỗi bảo mật:
                <a href="mailto:security@tiki.vn">security@sidebyside.vn</a>
              </p>
            </div>
            <div class="block">
              <h4>VỀ Side by Side</h4>
              <a
                rel="noreferrer"
                href="https://tiki.vn/gioi-thieu-ve-tiki"
                class="small-text"
                target="_blank"
                >Giới thiệu sidebyside</a
              ><a
                rel="noreferrer"
                href="https://tuyendung.tiki.vn"
                class="small-text"
                target="_blank"
                >Tuyển Dụng</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/bao-mat-thanh-toan"
                class="small-text"
                target="_blank"
                >Chính sách bảo mật thanh toán</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/bao-mat-thong-tin-ca-nhan"
                class="small-text"
                target="_blank"
                >Chính sách bảo mật thông tin cá nhân</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/articles/115005575826"
                class="small-text"
                target="_blank"
                >Chính sách giải quyết khiếu nại</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/articles/201971214"
                class="small-text"
                target="_blank"
                >Điều khoản sử dụng</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/articles/201710754-Tiki-Xu-l%C3%A0-g%C3%AC-Gi%C3%A1-tr%E1%BB%8B-quy-%C4%91%E1%BB%95i-nh%C6%B0-th%E1%BA%BF-n%C3%A0o"
                class="small-text"
                target="_blank"
                >Giới thiệu Tiki Xu</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/chuong-trinh/ban-hang-doanh-nghiep"
                class="small-text"
                target="_blank"
                >Bán hàng doanh nghiệp</a
              >
            </div>
            <div class="block">
              <h4>HỢP TÁC VÀ LIÊN KẾT</h4>
              <a
                rel="noreferrer"
                href="https://tiki.vn/quy-che-hoat-dong-sgdtmdt"
                class="small-text"
                target="_blank"
                >Quy chế hoạt động Sàn GDTMĐT</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/ban-hang-cung-tiki"
                class="small-text"
                target="_blank"
                >Bán hàng cùng sidebyside</a
              >
            </div>
            <div class="block">
              <h4>PHƯƠNG THỨC THANH TOÁN</h4>
              <p>
                <img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/visa.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/mastercard.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/jcb.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/cash.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/internet-banking.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/installment.svg"
                  width="54"
                  alt=""
                />
              </p>
            </div>
            <div class="block">
              <h4>KẾT NỐI VỚI CHÚNG TÔI</h4>
              <p>
                <a
                  rel="noreferrer"
                  href="https://www.facebook.com/Side-by-Side-100311098633597"
                  class="icon"
                  target="_blank"
                  title="Facebook"
                  ><img
                    src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/fb.svg"
                    width="32"
                    alt="" /></a
                ><a
                  rel="noreferrer"
                  href="https://www.youtube.com/channel/UC_uV8IYP4XF8R0acsXfERAg?view_as=subscriber"
                  class="icon"
                  target="_blank"
                  title="Youtube"
                  ><img
                    src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/youtube.svg"
                    width="32"
                    alt="" /></a
                ><a
                  rel="noreferrer"
                  href="http://zalo.me/589673439383195103"
                  class="icon"
                  target="_blank"
                  title="Zalo"
                  ><i class="icon tikicon icon-footer-zalo"></i
                ></a>
              </p>
              <h4 class="store-title">TẢI ỨNG DỤNG TRÊN ĐIỆN THOẠI</h4>
              <p>
                <a
                  rel="noreferrer"
                  href="https://itunes.apple.com/vn/app/id958100553"
                  class="icon"
                  target="_blank"
                  aria-label=""
                  ><img
                    src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/appstore.png"
                    width="134"
                    alt="" /></a
                ><a
                  rel="noreferrer"
                  href="https://play.google.com/store/apps/details?id=vn.tiki.app.tikiandroid"
                  class="icon"
                  target="_blank"
                  aria-label=""
                  ><img
                    src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/playstore.png"
                    width="134"
                    alt=""
                /></a>
              </p>
              </div>
          </div>
        </div>
</div>
</header>
  </body>
</html>

<!-- 
<div class="container">
    <div class="row">
        <div class="col-12">  
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Khởi tạo thanh toán</h3>
                </div>
                <div class="panel-body">
                    <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                          action="init_payment.php">
                        <div class="row"> -->
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">PartnerCode</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="partnerCode" value="<?php echo $partnerCode; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">AccessKey</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="accessKey" value="<?php echo $accessKey;?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">SecretKey</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="secretKey" value="<?php echo $secretKey; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div> -->
                        <!-- </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">OrderId</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderId" value="<?php echo $orderId; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">ExtraData</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' type="text" name="extraData" value="<?php echo $extraData?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">OrderInfo</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderInfo" value="<?php echo $orderInfo; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div> -->
                        <!-- </div> -->
                        <!-- <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Amount</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="amount" value="<?php echo $amount; ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">NotifyUrl</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="notifyUrl" value="<?php echo $notifyurl; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">ReturnUrl</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="returnUrl" value="<?php echo $returnUrl; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div> -->
                        <!-- </div>

                        <p>
                        <div style="margin-top: 1em;">
                            <button type="submit" class="btn btn-primary btn-block">Start MoMo payment....</button>
                        </div>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="./statics/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="./statics/moment/min/moment.min.js"></script>
<script type="text/javascript" src="./statics/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="./statics/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

</body>
</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="../../../css/client/css-fix/style.css" />
    <link rel="stylesheet" href="../../../icons/css/fontello.css" />
    <script src="https://kit.fontawesome.com/978d2e326d.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script type="text/javascript" src="./statics/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="./statics/moment/min/moment.min.js"></script>
<script type="text/javascript" src="./statics/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="./statics/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="./statics/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"/>
</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <a href="./index-fix.html"><img src="../../../images/logo.png" alt="" /></a>
            </div>
            <div class="menu">
                <div class="menu-top">
                    <div class="menu-top-list">
                        <ul>
                            <li><a href="#" class="a">Bán hàng cùng SBS</a></li>
                            <li><a href="#" class="a">Chăm sóc khách hàng</a></li>
                            <li><a href="#" class="a">Kiểm tra đơn hàng</a></li>
                            <li><a href="#" class="a">Chế độ tối</a></li>
                            <li><a href="#" class="a">Thay đổi ngôn ngữ</a></li>
                        </ul>
                    </div>
                    <div class="menu-top-login">
                        <p><a href="#">Đăng Nhập</a> <i class="icon-user-2"></i></p>
                    </div>
                </div>
                <div class="menu-bottom">
                    <div class="menu-bottom-category">
                        <p>
                            <a href="#" class="a1"><i class="icon-list-nested"></i> Danh mục</a
                >
              </p>
              <div class="hover">
                <div class="category">
                  <div class="category-hover">
                    <ul class="block-1">
                      <li>
                        <strong> Thiết bị di động</strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Điện tử - Điện lạnh </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Phụ kiện - Thiết bị số </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Laptop - Thiết bị IT </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Điện gia dụng </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Tiêu dùng - Thực phẩm </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Mẹ và bé </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Thời trang - Phụ kiện </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Phụ nữ - Làm đẹp </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Học tập </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Thể thao - Dã ngoại </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Y tế - Sức khỏe </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Giao thông - di chuyển </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Truyền thông - Giải trí </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                      <li>
                        <strong>Voucher - Dịch vụ </strong>
                        <span>
                          <i
                            class="fas fa-angle-right"
                            style="font-size: 18px"
                          ></i>
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="menu-bottom-search">
              <div class="menu-bottom-search-in">
                <input
                  type="text"
                  placeholder="Tìm kiếm sản phẩm, danh mục, đại lý..."
                /><a href="#"><i class="fas fa-search"></i></a>
                            <hr />
                    </div>
                </div>
                <div class="menu-bottom-cart">
                    <i class="fas fa-shopping-cart"></i
              ><span class="shopping-number">0</span>
            </div>
          </div>
        </div>
      </div>
      <div class="container-px-0">
        <div class="cart">
          GIỎ HÀNG<span class="counting">(1 sản phẩm)</span>
        </div>
        <div class="content-pay">
          <div class="seperate-left">
            <div class="product-trading">
              <a href="#">
                Side by Side Trading <i class="fas fa-angle-right"></i
              ></a>
            </div>
            <div class="information-product">
              <div class="image-product">
                <img src="../../../images/1.jpg" alt="" />
              </div>
              <div class="detail-product">
                <div class="detail-product-top">
                  <div class="detail-product-left">
                    <a class="item" href="#">
                      <span class="img"
                        ><img src="../../../images/logo.png" alt="" /></span
                      >Tai Nghe Nhét Tai Mi Basic Xiaomi HSEJ03JY - Hàng Chính
                      Hãng</a
                    >
                    <div class="word2">
                      <p class="ship-quickly">Hàng Giao 2H</p>
                    </div>
                    <div class="word2">
                      <span class="del">Xóa</span
                      ><span class="for-after">Để dành mùa sau</span>
                    </div>
                  </div>
                  <div class="detail-product-right">
                    <div class="price-item">
                      <h4>2.850.000</h4>
                      <h6><del>3.690.000</del> -23%</h6>
                    </div>
                    <div class="number">
                      <div class="CartQty__StyledCartQty-o1bx97-0 iaIXXn">
                        <span class="qty-decrease qty-disable">-</span
                        ><input type="tel" class="qty-input" value="1" /><span
                          class="qty-increase"
                          >+</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="seperate-right">
            <div class="detail-product-bottom-item">
              <div class="word5">
                <div class="word-item"><strong>Địa chỉ nhận hàng</strong></div>
                <div class="change"><a href="#">Thay đổi</a></div>
              </div>
              <div class="word"><p>Lê Hữu Quân / 0123456789</p></div>
              <div class="word1">
                <p>1/19 Cu Chinh Lan, Phường 13, Quận Tân Bình, Hồ Chí Minh</p>
              </div>
            </div>
            <div class="detail-product-bottom-item">
              <div class="word5">
                <div></div>
                <span class="word-item">Mã Khuyến Mãi</span>
                <span class="change"
                  >Có thể chọn 2<span
                    ><img
                      class="icon"
                      src="https://frontend.tikicdn.com/_desktop-next/static/img/mycoupon/icons-info-gray.svg"
                      alt="info"
                    /> </span
                ></span>
              </div>
              <div class="word3">
                <p>
                  <a href="#"
                    ><span
                      ><img
                        src="https://frontend.tikicdn.com/_desktop-next/static/img/mycoupon/coupon_icon.svg"
                    /></span>
                    Chọn hoặc nhập khuyễn mãi</a
                  >
                </p>
              </div>
            </div>
            <div class="detail-product-bottom-item">
              <div class="word5">
                <div class="word-item">Tạm Tính</div>
                <div class="change">2.850.000đ</div>
              </div>
              <hr />
              <div class="word5">
                <div class="word-item">Thành Tiền</div>
                <div class="change" > <input type="text" name="amount" value=""></div>
              </div>
              <div class="note">
                <span class="note-item">(Đã bao gồm thuế VAT nếu có)</span>
              </div>
            </div>
            <button type="submit" class="bought btn btn-primary btn-block">Tiến hành đặt hàng</button>
            <!-- <p>
                        <div style="margin-top: 1em;">
                            <button type="submit" class="btn btn-primary btn-block">Start MoMo payment....</button>
                        </div>
                        </p> -->
          <!-- </div>
        </div>
        <div
          class="Container-itwfbd-0 jFkAwY"
          style="height: 100px; padding-top: 32px"
        >
          <div class="NewsLetter-icon">
            <img
              src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/newsletter.png"
              width="163"
              alt=""
            />
          </div>
          <div class="NewsLetter-description">
            <h3>Đăng ký nhận bản tin Side by Side</h3>
            <h5>Đừng bỏ lỡ hàng ngàn sản phẩm và chương trình siêu hấp dẫn</h5>
          </div>
          <div class="NewsLetter-form">
            <div>
              <input
                type="email"
                placeholder="Địa chỉ email của bạn"
                value=""
              />
            </div>
            <button>Đăng ký</button>
          </div> -->
        <!-- </div>
        <div class="Footer__Information-e3clg6-3 dZezzK">
          <div
            class="Container-itwfbd-0 jFkAwY"
            style="display: flex; justify-content: space-between"
          >
            <div class="block" style="width: 268px">
              <h4>HỖ TRỢ KHÁCH HÀNG</h4>
              <p class="hotline">
                Hotline chăm sóc khách hàng:
                <a href="tel:1900-6035">1900-6035</a
                ><span class="small-text"
                  >(1000đ/phút , 8-21h kể cả T7, CN)</span
                >
              </p>
              <a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi"
                class="small-text"
                target="_blank"
                >Các câu hỏi thường gặp</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/requests/new"
                class="small-text"
                target="_blank"
                >Gửi yêu cầu hỗ trợ</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/categories/200126644"
                class="small-text"
                target="_blank"
                >Hướng dẫn đặt hàng</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/categories/200123960"
                class="small-text"
                target="_blank"
                >Phương thức vận chuyển</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/doi-tra-de-dang"
                class="small-text"
                target="_blank"
                >Chính sách đổi trả</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/chuong-trinh/dieu-kien-tra-gop"
                class="small-text"
                target="_blank"
                >Hướng dẫn trả góp</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/articles/360000822643"
                class="small-text"
                target="_blank"
                >Chính sách hàng nhập khẩu</a -->
              <!-- >
              <p class="security">
                Hỗ trợ khách hàng:
                <a href="mailto:hotro@tiki.vn">hotro@sidebyside.vn</a>
              </p>
              <p class="security">
                Báo lỗi bảo mật:
                <a href="mailto:security@tiki.vn">security@sidebyside.vn</a>
              </p>
            </div>
            <div class="block">
              <h4>VỀ Side by Side</h4>
              <a
                rel="noreferrer"
                href="https://tiki.vn/gioi-thieu-ve-tiki"
                class="small-text"
                target="_blank"
                >Giới thiệu sidebyside</a
              ><a
                rel="noreferrer"
                href="https://tuyendung.tiki.vn"
                class="small-text"
                target="_blank"
                >Tuyển Dụng</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/bao-mat-thanh-toan"
                class="small-text"
                target="_blank"
                >Chính sách bảo mật thanh toán</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/bao-mat-thong-tin-ca-nhan"
                class="small-text"
                target="_blank"
                >Chính sách bảo mật thông tin cá nhân</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/articles/115005575826"
                class="small-text"
                target="_blank"
                >Chính sách giải quyết khiếu nại</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/articles/201971214"
                class="small-text"
                target="_blank"
                >Điều khoản sử dụng</a
              ><a
                rel="noreferrer"
                href="https://hotro.tiki.vn/hc/vi/articles/201710754-Tiki-Xu-l%C3%A0-g%C3%AC-Gi%C3%A1-tr%E1%BB%8B-quy-%C4%91%E1%BB%95i-nh%C6%B0-th%E1%BA%BF-n%C3%A0o"
                class="small-text"
                target="_blank"
                >Giới thiệu Tiki Xu</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/chuong-trinh/ban-hang-doanh-nghiep"
                class="small-text"
                target="_blank"
                >Bán hàng doanh nghiệp</a
              >
            </div>
            <div class="block">
              <h4>HỢP TÁC VÀ LIÊN KẾT</h4>
              <a
                rel="noreferrer"
                href="https://tiki.vn/quy-che-hoat-dong-sgdtmdt"
                class="small-text"
                target="_blank"
                >Quy chế hoạt động Sàn GDTMĐT</a
              ><a
                rel="noreferrer"
                href="https://tiki.vn/ban-hang-cung-tiki"
                class="small-text"
                target="_blank"
                >Bán hàng cùng sidebyside</a
              >
            </div>
            <div class="block">
              <h4>PHƯƠNG THỨC THANH TOÁN</h4>
              <p>
                <img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/visa.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/mastercard.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/jcb.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/cash.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/internet-banking.svg"
                  width="54"
                  alt=""
                /><img
                  class="icon"
                  src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/installment.svg"
                  width="54"
                  alt=""
                />
              </p> -->
            <!-- </div>
            <div class="block">
              <h4>KẾT NỐI VỚI CHÚNG TÔI</h4>
              <p>
                <a
                  rel="noreferrer"
                  href="https://www.facebook.com/Side-by-Side-100311098633597"
                  class="icon"
                  target="_blank"
                  title="Facebook"
                  ><img
                    src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/fb.svg"
                    width="32"
                    alt="" /></a
                ><a
                  rel="noreferrer"
                  href="https://www.youtube.com/channel/UC_uV8IYP4XF8R0acsXfERAg?view_as=subscriber"
                  class="icon"
                  target="_blank"
                  title="Youtube"
                  ><img
                    src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/youtube.svg"
                    width="32"
                    alt="" /></a
                ><a
                  rel="noreferrer"
                  href="http://zalo.me/589673439383195103"
                  class="icon"
                  target="_blank"
                  title="Zalo"
                  ><i class="icon tikicon icon-footer-zalo"></i
                ></a>
              </p>
              <h4 class="store-title">TẢI ỨNG DỤNG TRÊN ĐIỆN THOẠI</h4>
              <p>
                <a
                  rel="noreferrer"
                  href="https://itunes.apple.com/vn/app/id958100553"
                  class="icon"
                  target="_blank"
                  aria-label=""
                  ><img
                    src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/appstore.png"
                    width="134"
                    alt="" /></a
                ><a
                  rel="noreferrer"
                  href="https://play.google.com/store/apps/details?id=vn.tiki.app.tikiandroid"
                  class="icon"
                  target="_blank"
                  aria-label=""
                  ><img
                    src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/playstore.png"
                    width="134"
                    alt=""
                /></a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </header>
  </body>
</html> --> 

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
}

img {
  max-width: 100%;
  max-height: 100%;
}

.header {
  max-width: 1200px;
  margin: 0 auto;
  height: 100px;
  display: flex;
}

.logo {
  width: 18%;
  height: 100px;
  margin-right: 2%;
}

.logo img {
  height: 60px;
  margin-top: 20px;
}

.menu {
  width: 80%;
}

.menu-top {
  height: 50%;
  display: flex;
}

.menu-top-list {
  width: 85%;
  font-size: 14px;
  color: #c6c4c4;
}
.menu-top-list ul {
  margin-bottom: 25px !important;
}
.menu-top-list li {
  margin-right: 25px;
  width: fit-content;
}
.menu-top-login {
  width: 15%;
  text-align: end;
  color: #0a4f70;
  font-size: 14px;
}

.menu-top-login p {
  margin-top: 11%;
  font-size: 14px;
}

.menu-top-login p i {
  font-size: 18px;
}

.menu-top-login p a {
  text-decoration: none;
  color: #0a4f70;
  margin-right: 10px;
}

.menu-bottom {
  height: 50%;
  display: flex;
  font-size: 20px;
  color: #0a4f70;
}

.menu-bottom-category {
  width: 20%;
  font-weight: 700;
  position: relative;
  font-size: 21px;
}

.menu-bottom-category .fa-align-right {
  margin-right: 20px;
}

.menu-bottom-search {
  width: 70%;
  text-align: left;
  font-size: 18px;
}

.menu-bottom-search i {
  font-size: 20px;
  width: 5%;
}

.menu-bottom-search input {
  color: #c5c3c4;
  font-size: 14px;
  width: 90%;
  border: 0;
  outline: none;
}

.menu-bottom-search-in {
  width: 60%;
  height: 20px;
  margin-left: 40%;
}
.menu-bottom-search-in a {
  text-decoration: none;
  color: #0a4f70;
}
.menu-bottom-search-in hr {
  width: 90%;
  border: none;
  height: 1px;
  background-color: #f04c63;
  margin-top: 0;
  margin-top: 0 !important;
}

.menu-bottom-cart {
  width: 10%;
  text-align: center;
  padding: 0px 20px;
  font-size: 20px;
  text-align: end;
}

.menu-bottom-cart i {
  font-size: 20px;
}

.menu-bottom p {
  font-size: 20px;
  height: 20px;
  margin-top: 1%;
}

.menu-top-list ul {
  display: flex;
  margin-top: 20px;
}

.menu-top-list ul li {
  font-size: 11pt;
  list-style: none;
  margin-right: 4%;
}

.banner {
  width: 100%;
  height: 450px;
  background-color: #51c5de;
}

.banner-item {
  padding-top: 1.5%;
  width: 87.9%;
  height: 95%;
  margin: 0 auto;
  display: flex;
}

.banner-left {
  width: 18%;
  background-color: #f8f6f7;
  margin-right: 2%;
  overflow: hidden;
}
.banner-right {
  width: 80%;
  background-color: #f8f6f7;
}
.category {
  width: 948.61px;
  z-index: 1;
  margin: 0 auto;
  display: none;
  background-color: white;
}
.hover {
  position: absolute;
  padding-top: 50px;
  z-index: 99;
  left: 2%;
  top: 40%;
}
.menu-bottom-category:hover .category {
  display: block;
}
.category-hover {
  top: 0;
  height: 407.63px;
  z-index: -99;
  display: flex;
  background-color: rgb(235, 235, 235);
}
.category:hover .menu-bottom-category {
  display: block;
}
.category-hover .block-1 {
  width: 35%;
  margin-right: 10%;
  font-size: 11pt;
  background-color: white;
  height: 100%;
}

.category-hover .block-1 li {
  float: left;
  list-style: none;
  height: 20px;
  margin-bottom: 7.85px;
  width: 100%;
  color: #0a4f70;
  position: relative;
  padding: 0px 20px;
  cursor: pointer;
  z-index: 1;
}

.category-hover .block-1 li:hover {
  transition: 1s;
}

.category-hover .block-1 li::before {
  background-color: #f7f6f6;
  width: 0%;
  height: 100%;
  top: 0px;
  position: absolute;
  z-index: -11;
  left: 0;
  content: "";
  border-radius: 0% 0% 0% 0%;
}

.category-hover .block-1 li:hover::before {
  width: 100%;
  bottom: 0px;
  height: 100%;
  transition: 0.5s;
}

.category-hover .block-1 li:hover {
  color: white;
}

.category-hover .block-1 li:hover strong {
  color: #f04c63;
}

.category-hover .block-1 li:hover {
  transition: 0.5s;
}

.category-hover .block-1 li span {
  float: right;
}

.category-hover .block-2 {
  margin-top: 20px;
  height: 140px;
  background-color: rgb(255, 255, 255);
}

.category-hover .block-2 strong {
  width: 100%;
  float: left;
  height: 30px;
}

.category-hover .block-2 li {
  width: 100%;
  font-size: 11pt;
  float: left;
  color: gray;
  height: 30px;
  list-style: none;
}

.category-hover .block-2 li:hover {
  color: #51c5de;
  transition: 0.5s;
}
.footer-item {
  max-width: 1200px;
  margin: 0 auto;
}
.footer-item-highlights {
  width: 45%;
  background-color: #51c5de;
  margin-top: 2%;
}
h2 {
  color: white;
}
.footer-content {
  width: 90%;
  margin: 0 auto;
  padding-top: 2%;
}
.footer-content-menu {
  width: 90%;
  margin: 0 auto;
  margin-top: 2%;
  display: flex;
}
.footer-content-menu-item {
  width: 23%;
  margin-right: 2%;
  background-color: #f8f6f7;
  margin-bottom: 2%;
  border-radius: 5px;
  text-align: center;
}
.footer-content-menu-item:last-child {
  margin-right: 0;
}
.item-icon {
  margin-top: 10%;
  font-size: 1.8rem;
  color: #51c5de;
}
.item-content {
  font-size: 1rem;
  color: #81a2b3;
  margin-bottom: 10%;
}
.shopping-number {
  padding: 0 5px;
  color: #f24c64;
  font-size: 12px;
}
.a {
  text-decoration: none;
  color: #c6c4c4;
}
.a1 {
  text-decoration: none;
  color: #0a4f70;
}
.container-product {
  max-width: 1200px !important;
  margin: 0 auto;
}
.title-sale {
  padding: 20px;
  color: #f04c36;
}
.row-container-product {
  max-width: 1200px;
  margin: 0 auto;
  background-color: white;
}
.row-sale {
  display: flex;
}
.col-bg-dark {
  display: flex;
  width: 1160px;
  margin: 0 auto;
}
.box-product {
  width: 18%;
  height: 280px;
}
.container-px-0 {
  background-color: #f8f6f7;
  padding: 20px;
}
.product {
  width: 90%;
  margin: 0 auto;
  position: relative;
}
.product-image {
  height: 190px;
}
.product-price {
  color: red;
  text-align: center;
}
.product-link {
  color: black;
  font-size: 12px;
  text-decoration: none;
}
.sale {
  position: absolute;
  top: 0;
  left: 0;
  font-size: 8pt;
  width: 26px;
  height: 20px;
}
.sale-item {
  text-align: center;
  background-color: #f24c64;
  color: white;
  height: 70%;
}
.triangle {
  border-left: 12px solid transparent;
  border-right: 12px solid transparent;
  border-top: 8px solid #f24c64;
}
.button-more {
  text-align: center;
}
.more {
  width: 10%;
  margin-top: 3%;
  text-align: center;
  color: #51c5de;
  background-color: white;
  border: solid 1px #51c5de;
}
.time {
  padding: 20px;
  color: #0a4f70;
  margin-left: 71%;
  font-size: 18px;
}
.box-product:hover {
  box-shadow: #c6c4c4 0px 3px 5px;
}
.foryou {
  font-size: 21px;
  color: black;
}

.prev-arrow-carousel::before {
  color: red;
}

.next-arrow-carousel::before {
  color: red;
}
.word-pp {
  padding: 10px;
  margin: 10px;
  border: solid 1px #c6c4c4;
  background-color: #c6c4c4;
  border-radius: 5px;
  text-align: center;
}
.iphone {
  margin-top: 15px;
}
del {
  color: rgb(189, 67, 67);
}
.tab {
  overflow: hidden;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
  color: rgb(13, 92, 182);
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border-top: none;
}
.tabcontent.active {
  display: block;
  background-color: white;
}
.tab {
  background-color: white;
  width: 45%;
  margin: 0 auto;
}
.tablinks {
  border: 1px solid #ccc;
  margin-right: 5px;
}
a {
  text-decoration: none;
}
* {
  box-sizing: border-box;
}
body {
  font-family: Verdana, sans-serif;
}
.mySlides {
  display: none;
}
img {
  vertical-align: middle;
}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 10px;
  width: 10px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}
.dots {
  position: absolute;
  top: 78%;
  right: 40%;
}
/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {
    opacity: 0.4;
  }
  to {
    opacity: 1;
  }
}

@keyframes fade {
  from {
    opacity: 0.4;
  }
  to {
    opacity: 1;
  }
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {
    font-size: 11px;
  }
}
.song {
  width: 213.44px;
  transition: 0.3s;
}
.song:hover {
  transform: scale(1.2);
}

/*footer*/
.footer-banner {
  background-color: black;
  width: 100%;
  min-height: 124px;
  margin: 0 auto;
}

.footer-menu-content {
  width: 1200px;
  margin: 0 auto;
  min-height: 400px;
}

/* .bg-title {
  background-color: chartreuse; */
/* } */
.bg-title h4 {
  font-size: 18px;
  padding: 5px 0px;
}

.bg-title-2 {
  min-height: 200px;
}

.footer-item-ul {
  display: inline-block;
}

.li-menu li {
  display: inline-block;
  width: auto;
  height: 10px;
  padding: 10px;
}
.li-menu a {
  font-size: 14px;
  line-height: 2;
  color: #51c5dd;
  transition: 0.25s all;
}
.li-menu a:hover {
  color: #f04c63;
}
.footer-item-ul li {
  padding-bottom: 4px;
}

.footer-map {
  width: 100%;
  height: 100%;
}

.footer-hotline {
  width: 277.5px;
  min-height: 64px;
}

.footer-hotline .footer-hotline-img {
  float: left;
  width: 30%;
  height: 64px;
}
.footer-hotline .footer-hotline-img img {
  width: 80%;
  object-fit: cover;
}

.footer-hotline .footer-hotline-tel {
  float: right;
  width: 70%;
  height: 64px;
}
.footer-hotline .footer-hotline-tel p {
  color: #f04c63;
  font-size: 14px;
  padding: 2px;
  margin-bottom: 0 !important;
}
.footer-hotline .footer-hotline-tel span {
  color: #c6c4c4;
  font-size: 14px;
}

.footer-link {
  width: 277.5px;
  min-height: 64px;
}
.footer-link-title {
  width: 100%;
  min-height: 50%;
}
.footer-link-title h4 {
  font-size: 18px;
}

.footer-link-item {
  width: 100%;
  min-height: 32px;
}
.footer-link-item-box {
  float: left;
  width: 30px;
  min-height: 32px;
  text-align: center;
  border-radius: 50%;
  margin: 2px;
  padding: 2px;
}
.footer-link-item-box i {
  line-height: 30px;
}
.footer-link-item-box .footer-link-fb {
  background-color: #0570e6;
}

.footer-license {
  background-color: black;
  margin: 0 auto;
  min-height: 50px;
}
.footer-license-box {
  margin: 0 auto;
  width: 1200px;
  min-height: 50px;
}
.footer-license-box-span {
  width: 100%;
  text-align: center;
  height: 40px;
}

.footer-pay {
  width: 1200px;
  min-height: 80px;
  margin: 0 auto;
}
.content-pay {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  margin-top: 10px;
}
.cart {
  max-width: 1200px;
  margin: 0 auto;
  font-size: 18px;
}
.counting {
  font-size: 14px;
}
.seperate-left {
  width: 910px;
  height: 250px;
  background-color: white;
}
.seperate-right {
  width: 320px;
  height: 500px;
  background-color: #f8f6f7;
  justify-content: end;
}
.product-trading {
  font-size: 15px;
  line-height: 24px;
  font-weight: 500;
  padding: 14px 0px 10px 20px;
}
.product-trading a {
  color: rgb(36, 36, 36);
  -webkit-box-align: center;
  align-items: center;
  text-decoration: none;
  cursor: pointer;
}
.image-product {
  width: 170px;
  padding: 0 20px;
  margin-top: 40px;
}
.detail-product {
  margin-top: 40px;
  width: 720px;
  height: 134px;
}
.information-product {
  display: flex;
}
.detail-product-top {
  display: flex;
}
.detail-product-left {
  width: 432px;
}
.detail-product-right {
  width: 230px;
  margin-left: 70px;
  display: flex;
}
.img {
  width: 35px;
  display: inline-block;
  vertical-align: top;
}
.item {
  text-decoration: none;
  color: black;
}
.detail-product-bottom {
  width: 227.86px;
  margin-left: 20px;
}
.detail-product-bottom-item {
  width: 315px;
  margin-left: 20px;
  background-color: white;
  padding: 15px 10px;
  margin-bottom: 10px;
}
.word-item {
  width: 50%;
}
.change {
  width: 50%;
  text-align: end;
}
.change a {
  color: rgb(13, 92, 182);
  text-decoration: none;
}
.word {
  font-size: 15px;
  margin-top: 15px;
  color: rgb(36, 36, 36);
}
.word1 {
  margin-top: 15px;
  font-size: 13px;
  color: rgb(120, 120, 120);
}
.word2 {
  margin-top: 10px;
}
.del {
  margin-right: 20px;
  color: rgb(13, 92, 182);
  font-size: 13px;
}
.for-after {
  color: rgb(13, 92, 182);
  font-size: 13px;
}
.ship-quickly {
  color: rgb(0, 153, 0);
  font-size: 12px;
  font-weight: 500;
}
.icon {
  width: 22x;
}
.word3 {
  margin-top: 15px;
  font-size: 13px;
  color: rgb(13, 92, 182);
}
.bought {
  background: rgb(255, 66, 78);
  color: rgb(255, 255, 255);
  padding: 13px 10px;
  text-align: center;
  border-radius: 4px;
  border: none;
  width: 100%;
  display: block;
  margin: 15px 0px;
  cursor: pointer;
  margin-left: 20px;
  outline: none;
}
.jFkAwY {
  width: 1270px;
  padding-left: 15px;
  padding-right: 15px;
  margin-right: auto;
  margin-left: auto;
}
.NewsLetter-icon {
  margin-top: -40px;
  margin-right: 20px;
}
.NewsLetter-description {
  margin-right: 30px;
  margin-bottom: 0px;
  color: rgb(78, 80, 82);
}
.NewsLetter-form {
  display: flex;
}
.NewsLetter-form input {
  flex: 1 1 0%;
  width: 345px;
  height: 34px;
  margin-right: 10px;
  padding: 6px 12px;
  background-color: rgb(255, 255, 255);
  border: 1px solid rgb(204, 204, 204);
  border-radius: 4px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
}
.NewsLetter-form button {
  cursor: pointer;
  height: 34px;
  padding: 6px 12px;
  color: rgb(255, 255, 255);
  font-size: 14px;
  line-height: 1.42857;
  border: none;
  border-radius: 4px;
  background-color: rgb(0, 175, 239);
  outline: none;
}
button,
input {
  overflow: visible;
}
.Container-itwfbd-0 {
  color: rgb(78, 80, 82);
  display: flex;
}
.word5 {
  padding: 5px;
  display: flex;
}
.note {
  font-weight: 300;
  font-style: normal;
  display: block;
  font-size: 12px;
  color: rgb(51, 51, 51);
  margin-top: 3px;
  text-align: end;
}
.detail-product-bottom-item hr {
  margin: 20px 0;
}
.bought:hover {
  background-color: #ff0f1e;
}
/* number */
.iaIXXn {
  display: flex;
  flex-wrap: nowrap;
  border: 1px solid rgb(200, 200, 200);
  border-radius: 3px;
}
.qty-decrease.qty-disable {
  border-radius: 3px 0px 0px 3px;
}
.qty-disable {
  pointer-events: none;
  background: rgb(248, 248, 248);
}
.iaIXXn .qty-decrease,
.iaIXXn .qty-increase {
  display: inline-block;
  border-right: 1px solid rgb(200, 200, 200);
  color: rgb(153, 153, 153);
  padding: 6px 12px;
  cursor: pointer;
}
.qty-input {
  border: none;
  background: transparent;
  width: 35px;
  text-align: center;
  font-size: 13px;
  appearance: none;
  margin: 0px;
}
.iaIXXn .qty-increase {
  border-right: none;
  border-left: 1px solid rgb(200, 200, 200);
}
.iaIXXn .qty-decrease,
.iaIXXn .qty-increase {
  display: inline-block;
  border-right: 1px solid rgb(200, 200, 200);
  color: rgb(153, 153, 153);
  padding: 6px 12px;
  cursor: pointer;
}
.number {
  margin-left: 25px;
}
/* footer */
.dZezzK {
  padding: 40px 0px;
  border-top: 1px solid rgb(247, 247, 247);
  border-bottom: 1px solid rgb(247, 247, 247);
  background-color: rgb(255, 255, 255);
}
.hotline {
  margin-bottom: 10px;
  color: rgb(196, 1, 26);
  font-size: 14px;
  font-weight: 500;
  line-height: 18px;
}
.small-text {
  display: block;
  margin-bottom: 11px;
  color: rgb(51, 51, 51);
  font-size: 12px;
  font-weight: normal;
}
.security {
  margin-bottom: 10px;
  color: rgb(51, 51, 51);
  font-size: 12px;
  font-weight: 400;
}
p {
  margin: 0px 0px 10px;
}
.block {
  width: 226px;
}
.dZezzK .block .icon {
  display: inline-block;
  margin-right: 10px;
  margin-bottom: 7px;
  vertical-align: middle;
}
.icon {
  display: inline-block;
  vertical-align: middle;
  background-repeat: no-repeat;
  background-position: 0px 0px;
}

</style>