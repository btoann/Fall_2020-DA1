<div id="dark2" class="right">

<div class="right__profile">
    <div class="right__image">
        <img src="seller/assets/profile.jpg" alt="">
        <div class="right__image__edit">
            <i class="fa fa-pen" style="font-size:12px"></i>
        </div>
    </div>
</div>

<div class="info__bell">
    <i class='far fa-bell'> <div class="dot">2</div></i>
</div>
<div class="info__bell mt">
    <i style="font-size: 21px;" class='far fa-comment'> <div class="dot">1</div></i>

</div>
<hr class="line">
<div class="button__hidden">
    <div class="container__button">
        <!-- <div class="toggle__btn " onclick="this.classList.toggle('active')"> -->
        <!-- <i id="click__me" class="fa fa-circle-o"></i> -->

        <input type="checkbox" class="checkbox" id="checkbox">
        <label for="checkbox" class="label">
                        <i class="far fa-moon"></i>
                        <i class="fas fa-sun"></i>
                        <div class="ball"></div>
                    </label>

        <!-- 
        </div> -->

    </div>
</div>
<hr class="line">
<div class="qr__code mt edit">
    <i id="click__show__qr" onclick="qr__show()" class="fa fa-qrcode"></i>


</div>
<div class="info mt edit">
    <i id="click__show__info"  class="fa fa-info-circle "></i>
</div>
<div class="info__set mt edit">
    <i onclick="set__show()" class="fa fa-gear"></i>
</div>
<div class="right__hover">
    <div class="info__top">
        <li>Nguyen Duc Sy</li>
        <li>SDT : 0702434097</li>
        <li>Name Mart : ........ </li>

    </div>

    <hr>
</div>  
      <div id="info__show" class="info__page">
        <li>Phương thức vận chuyển</li>
        <li>Cơ hội nghề nghiệp</li>
        <li>Chính sách đổi trả</li>
        <li>Hướng dẫn sử dụng </li>
    </div>
</div>
</div>
</div>
</div>
<div id="qr" class="qr__show">
<img class="qr__inside" src="seller/images/QR.png" alt="">
<i onclick="close__qr()" class="fa fa-close"></i>
<p>Vui lòng giữ nguyên 3s</p>
</div>
<script>
function qr__show() {
document.getElementById('qr').style.display = "block";
}

function close__qr() {
document.getElementById('qr').style.display = "none";

}


</script>
</div>

<!-- <script src="seller/js/main.js"></script> -->

</body>

</html>


<script>
$(document).ready(function(){
  $("#click__show__info").click(function(){
    $("#info__show").toggle();
  });
});
</script>



