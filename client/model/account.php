<?php

    include_once '.system/lib/controller.php';
    
    function login($user)
    {
        $sql = 'SELECT * FROM users WHERE email = "'.$user.'" OR tel = "'.$user.'"';
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
    }

    function verify_mail($to, $user_id, $activation)
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
                    <title>Xác nhận tài khoản</title>
                </head>
                <body>
                    <p>
                        Chúng tôi muốn xác thực bạn là chủ sở hữu email này.
                        <br/>
                        Hãy chắc chắn rằng bạn nhận được mail của chúng tôi và không chia sẻ nó cho bất cứ ai.</p>
                    <p>
                        <a href="index.php?ctrl=account&act=user&id='.$user_id.'&verify='.$activation.'">
                            index.php?ctrl=account&act=user&id='.$user_id.'&verify='.$activation.'
                        </a>
                    </p>
                </body>
            </html>';
        
        mail($to, $subject, $messenge, $headers);
    }

?>

