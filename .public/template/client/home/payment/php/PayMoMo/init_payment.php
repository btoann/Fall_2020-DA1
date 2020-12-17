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
          <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <a href="http://localhost/fall2020/da/git/btoann.github.io/index.php"><img src="./img/images/logo.png" alt="" /></a>
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
        <div style="height: 90vh" class="content-pay">
          <div class="seperate-left">
            <div class="product-trading">
              <a href="#">
                Side by Side Trading <i class="fas fa-angle-right"></i
              ></a>
            </div>
            <div class="information-product">
              <div class="image-product">
                <img src="./img/images/1.jpg" alt="" />
              </div>
              <div class="detail-product">
                <div class="detail-product-top">
                  <div class="detail-product-left">
                    <a class="item" href="#">
                      Tai Nghe Nhét Tai Mi Basic Xiaomi HSEJ03JY - Hàng Chính
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

              <input style="display:none" type='text' name="orderId" value="<?php echo $orderId; ?>"  class="form-control"/>

              <input style="display: none" type='text' type="text" name="extraData" value="<?php echo $extraData?>"    class="form-control"/>

              <input style="display: none" type='text' name="orderInfo" value="<?php echo $orderInfo; ?>"  class="form-control"/>

              <input style="display: none" type='text' name="notifyUrl" value="<?php echo $notifyurl; ?>"  class="form-control"/>

              <input style="display: none" type='text' name="returnUrl" value="<?php echo $returnUrl; ?>" class="form-control"/>

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
            <div style="height:100px" class="detail-product-bottom-item">
              <div class="word5">
                <div></div>
                <span style="width: 70%" class="word-item">Phương thức thanh toán</span> 
              </div>
              <div  class="word3">
          
                    <div class="pay momo"><img src="img/momo_logo.png" alt="">      
                       
                          <input style="float: right;margin-top:-27px;margin-left:20px" id="radio-1" name="radio" type="radio" checked>
                          <label for="radio-1" class="radio-label"></label>
                       
                      </div>

                    <div class="pay default"><i style="padding: 0px 5px;color:grey" class="fas fa-money-bill-wave"></i>Thanh toán khi nhận hàng 
              
                      <input style="float:right" id="radio-1" name="radio" type="radio" disabled>
                      <label for="radio-1" class="radio-label"></label>
       
                  </div>
         

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
                <div class="change" > <input style="border: none;width:100%;text-align:right" type="text" name="amount" value="1000"></div>
      
              </div>
              <div class="note">
                <span class="note-item">(Đã bao gồm thuế VAT nếu có)</span>
              </div>
            </div>
            <button type="submit" class="bought btn btn-primary btn-block">Tiến hành đặt hàng</button>
        
                </form>
          </div>
        </div>
        <div
          class="Container-itwfbd-0 jFkAwY"
          style="height: 100px; padding-top: 32px;margin-bottom:20px"
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


