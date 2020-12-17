<?php
        // session_start();
        include_once '../../../.system/core/connect.php';
        include "./cmt.php";
        // include "../model/user.php";

        // if(isset($_SESSION['sid']) && ($_SESSION['sid']>0)){

        //     if(isset($_SESSION['suser']) && ($_SESSION['suser'] != "" )){
        //         $user = $_SESSION['suser'];
        //     }
            // else $user = "";

            if(isset($_POST['guibinhluan']) && ($_POST['guibinhluan'])){
                // if(isset($_POST['idsp']) && ($_POST['idsp'])>0){
              
                // // $idsp = $_POST['idsp'];
                // $iduser = $_SESSION['sid'];
                $noidung = $_POST['noidung'];
                // $postdate = $_SESSION['postdate'];
                echo $noidung;
                capnhap_cmt( $noidung);
         
            }
       
          
         
        // }
  
             

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./binhluan.css">
    <title>Comment</title>
</head>
<body>


          <p>Bình luận</p>
<form action="binhluan.php" method="post">
    <!-- <input type="hidden" name="idsp" value="<?=$_GET['idsp']?>"> -->
 <div class="noidung">   <textarea name="noidung" id="" cols="30" rows="1" placeholder="Hãy nói điều gì đó..."></textarea><hr></div>
 <button  type="submit" value="send" name="guibinhluan" style="font-size:24px"><ins>0/200</ins> <i class="material-icons">send</i></button>
 </form>
 <h2 style="margin-top: 50px;"></h2>
 <?php
       
      
//        if(isset($_GET['idsp']) && ($_GET['idsp'])>0){
//            $idsp = $_GET['idsp'];
     
//        $dsbl = show_cmt($idsp);
//        foreach($dsbl as $bll){
//            $noidung = $bll['noidung'];
//            $avatar = "../view/img/avataruser.jpg";
//            echo '       
//                <nav>  <img src="'.$avatar.'" alt=""><span>'.$user.'</span> : '.$noidung.'</nav>
//            ';            
//        }
//    }
//        else  echo "khong update duoc ";
   ?>



<style>
        nav{
            min-height: 30px;
        }
        nav img{
            width: 10%;
            margin-top: -5px;
            border-radius: 50px;
            margin-right: 10px;
            float: left;
        }
</style>
</body>
</html>   
 <?php
        // }else{
        //     echo '<a href="login.php" target="_parent">Vui lòng đăng nhập :)) </a>';
        // }
    ?>
