<?php

    include_once '.system/lib/controller.php';
    
    function signin($user)
    {
        $sql = 'SELECT * FROM users WHERE email = "'.$user.'" OR tel = "'.$user.'" AND (role >= 0 AND role < 20)';
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function signup($name, $email, $tel, $pass)
    {
        $sql = "INSERT INTO users (name, email, tel, pass)
                        VALUES ('$name', '$email', '$tel', '$pass')";
        $dtb = new database();
        $dtb->execute($sql);
    }

    function signin_social($user, $role)
    {
        $sql = 'SELECT id, name, email, tel, avatar, cardimage, birth, date, role
                    FROM users WHERE email = "'.$user.'" AND role = "'.$role.'"';
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function signup_social($name, $email, $role)
    {
        $pass = md5($email);
        $sql = "INSERT INTO users (name, email, tel, pass, role)
                        VALUES ('$name', '$email', '0', '$pass', '$role')";
        $dtb = new database();
        $dtb->execute($sql);
    }
    
    function create_activation($id, $email)
    {
        // Mã hoá email theo mỗi lần cập nhật
        $code = md5($email.time());
        $sql = "UPDATE users SET activation = '$code' WHERE id = '$id'";
        $dtb = new database();
        $dtb->execute($sql);

        return $code;
    }

    function get_verify($id, $code)
    {
        $sql = 'SELECT id FROM users WHERE activation = "'.$code.'" AND id = "'.$id.'"';
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function verify_account($id, $code)
    {
        $sql = "UPDATE users SET role = '10' WHERE activation = '$code' AND id = '$id'";
        $dtb = new database();
        $dtb->execute($sql);

        $sql = 'SELECT role FROM users WHERE id = '.$id;
        return $dtb->queryOne($sql);
    }

    function verify_mail($to_email, $to_name, $user_id, $activation)
    {
        include '.system/lib/PHPMailer/class.phpmailer.php';
        include '.system/lib/PHPMailer/class.smtp.php';
        include '.system/lib/PHPMailer/Exception.php';
        include '.system/lib/PHPMailer/OAuth.php';
        include '.system/lib/PHPMailer/PHPMailer.php';
        include '.system/lib/PHPMailer/POP3.php';
        include '.system/lib/PHPMailer/SMTP.php';
 
        $mail = new PHPMailer(true);

        try{   
            $mail->SMTPDebug = 4;  
            $mail->isSMTP();
            $mail ->CharSet = "UTF-8";
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'shop.sidebyside@gmail.com';                     // SMTP username
            $mail->Password   = 'sidebyside2020';     
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;  

            $mail->setFrom('systemsbs@xxx.com', 'sidebyside.shop');
            $mail->addAddress($to_email, $to_name);  

            $mail->isHTML(true);
            $mail->Subject = 'Xác thực tài khoản';
            $mail->Body    = 
                '<!DOCTYPE html>
                    <html lang="vn">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <title>Xác nhận tài khoản</title>
                    </head>
                    <body>
                        <p>
                            Chúng tôi muốn xác thực bạn là chủ sở hữu email này.
                            <br/>
                            Hãy chắc chắn rằng bạn nhận được mail của chúng tôi và không chia sẻ nó cho bất cứ ai.</p>
                        <p>
                            <a href="http://localhost:8888/btoann.github.io/index.php?ctrl=account&act=user&id='.$user_id.'&verify='.$activation.'">
                                link xác thực
                            </a>
                        </p>
                    </body>
                </html>';

            $mail->send();
            
            echo 'Đơn hàng đã được gửi đi';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

?>

