<?php
header('Content-type: text/html; charset=utf-8');

$config = file_get_contents('client/view/payment/php/config.json');
$array = json_decode($config, true);

include "client/view/payment/php/common/helper.php";

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
    $notifyurl = "http://localhost:8888/btoann.github.io/client/view/payment/php/PayMoMo/ipn_momo.php";
    // $_POST["notifyUrl"];
    $returnUrl = "http://localhost:8888/btoann.github.io/client/view/payment/php/PayMoMo/result.php";
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="./statics/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href=".public/css/client/css-fix/style.css" />
    <link rel="stylesheet" href=".public/.public/icons/css/fontello.css" />
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
          <link rel="stylesheet" href="client/view/payment/php/PayMoMo/css/style.css">
        

    <div class="header">
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

                        <span class="qty-decrease" onclick="minus()" > - </span>
                        
                        <input type="tel" class="qty-input" value="1" id="count" />

                        <span class="qty-increase" onclick="plus()">+</span>

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
                <span class="word-item" style="font-weight:600 ">Mã Khuyến Mãi</span>
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
                    Chọn hoặc nhập huyễn mãi</a
                  >
                </p>
              </div>
            </div>
            <div style="height:100px" class="detail-product-bottom-item">
              <div class="word5">
                <div></div>
                <span style="width: 70%;font-weight:600" class="word-item">Phương thức thanh toán</span> 
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
        
<script>
var count = 1;
var countEl = document.getElementById('count');

function plus() {
    count++;
    countEl.value = count;
}

function minus() {
    if (count > 1) {
        count--;
        countEl.value = count;
    }
}
</script>
</header>
  </body>
</html>


