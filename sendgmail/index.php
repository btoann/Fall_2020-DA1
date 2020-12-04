<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <aside>
    <form action="" method="post">
        <input type="text" name="ten" placeholder="Ho va Ten">
        <input type="email" name="email" placeholder="Email">
        <input type="text" placeholder="Pass">
        <input type="submit" placeholder="Send" value="SEND">

    
        </form>
    <?php
  
        include './PHPMailer/Exception.php';
        include './PHPMailer/OAuth.php';
        include './PHPMailer/PHPMailer.php';
        include './PHPMailer/POP3.php';
        include './PHPMailer/SMTP.php';
    

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
 
        $mail = new PHPMailer(true);

    try{   
        $mail->SMTPDebug = 4;  
        $mail->isSMTP();
        $mail ->CharSet = "UTF-8";
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;      
        $mail->Username   = 'sidebyside753@gmail.com';                     // SMTP username
        $mail->Password   = 'sbs123456@';     
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;  

        $meo = $_POST['email'];
        $name = $_POST['ten'];
        $mail->setFrom('systemsbs@xxx.com', 'Mailer');
        $mail->addAddress($meo, $name);  

        $mail->isHTML(true);   
        $mail->Subject = 'Hello các member . Today I feel so good';
        $mail->Body    = 'Noi dung mua hang';

        $mail->send();
        echo 'Đơn hàng đã được gữi đi ';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    ?>


    </aside>

</body>

</html>