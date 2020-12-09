<?php

    include_once '.system/lib/controller.php';

    function signin($user)
    {
        $sql = 'SELECT * FROM sellers WHERE email = "'.$user.'" OR tel = "'.$user.'"';
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function signup($name, $email, $tel, $address, $pass, $role)
    {
        $sql = "INSERT INTO sellers (name, email, tel, address, pass, role)
                        VALUES ('$name', '$email', '$tel', '$address', '$pass', '$role')";
        $dtb = new database();
        $dtb->execute($sql);
    }
    
    function create_activation($id, $email)
    {
        // Mã hoá email theo mỗi lần cập nhật
        $code = md5($email.time());
        $sql = "UPDATE sellers SET activation = '$code' WHERE id = '$id'";
        $dtb = new database();
        $dtb->execute($sql);

        return $code;
    }

    function get_verify($id, $code)
    {
        $sql = 'SELECT id FROM sellers WHERE activation = "'.$code.'" AND id = "'.$id.'"';
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function verify_account($id, $code)
    {
        $sql = "UPDATE sellers SET activation = '' WHERE activation = '$code' AND id = '$id'";
        $dtb = new database();
        $dtb->execute($sql);
    }

    function abc($to, $user_id, $activation)
    {
        // sending email
        $subject = 'Xác thực tài khoản';
        $from = 'shop.sidebyside@gmail.com';
        
        $headers = 'MIME-Version: 1.0'.'\r\n';
        $headers .= 'From: sidebyside.shop <'.$from.'>\r\n';
        $headers .= 'Reply-To: '.$to.'\r\n';
        $headers .= 'Content-type: text/html;charset=UTF-8\r\n';
        $headers .= 'X-Mailer: PHP/'.phpversion();

        $messenge =
            '<!DOCTYPE html>
                <html lang="vn">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Xác nhận trở thành cộng tác viên</title>
                </head>
                <body>
                    <p>
                        Xác nhận email để trở thành cộng tác viên với chúng tôi.
                        <br/>
                        Hãy chắc chắn rằng bạn nhận được mail của chúng tôi và không chia sẻ nó cho bất cứ ai.</p>
                    <p>
                        <a href="seller.php?ctrl=account&act=user&id='.$user_id.'&verify='.$activation.'">
                            seller.php?ctrl=account&act=user&id='.$user_id.'&verify='.$activation.'
                        </a>
                    </p>
                </body>
            </html>';
        
        mail($to, $subject, $messenge, $headers);
    }

    function verify_mail($to_email, $to_name, $user_id, $activation)
    {
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

            $mail->setFrom('systemsbs@xxx.com', 'Mailer');
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
                        <title>Xác nhận trở thành cộng tác viên</title>
                    </head>
                    <body>
                        <p>
                            Xác nhận email để trở thành cộng tác viên với chúng tôi.
                            <br/>
                            Hãy chắc chắn rằng bạn nhận được mail của chúng tôi và không chia sẻ nó cho bất cứ ai.</p>
                        <p>
                            <a href="seller.php?ctrl=account&act=user&id='.$user_id.'&verify='.$activation.'">
                                seller.php?ctrl=account&act=user&id='.$user_id.'&verify='.$activation.'
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

