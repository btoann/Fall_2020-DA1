<?php

    include_once '.system/lib/controller.php';
    include_once '.system/lib/mailer.php';
    
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
        if($id > 0)
            $sql = "UPDATE users SET activation = '$code' WHERE id = '$id'";
        else
            $sql = "UPDATE users SET activation = '$code' WHERE email = '$email' AND (role >= 10 AND role < 20)";
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
        $sql = "UPDATE users SET role = '10', activation = NULL WHERE activation = '$code' AND id = '$id'";
        $dtb = new database();
        $dtb->execute($sql);

        $sql = 'SELECT role FROM users WHERE id = '.$id;
        return $dtb->queryOne($sql);
    }

    function verify_mail($to_email, $to_name, $user_id, $activation)
    {
        $subject = 'Xác thực tài khoản';
        $content =
            '<!DOCTYPE html>
                <html lang="vi">
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

        $mailer = new mailer();
        $mailer->sendmail($to_email, $to_name, $subject, $content);
    }

    function reset_password($id, $code, $pass)
    {
        $sql = "UPDATE users SET pass = '$pass', activation = NULL WHERE id = '$id' AND activation = '$code'";
        $dtb = new database();
        $dtb->execute($sql);
    }

    function reset_activation($id, $code)
    {
        $sql =
            "CREATE EVENT IF NOT EXISTS reset_activation_".$id."
            ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 5 MINUTE
            DO
                UPDATE users SET activation = NULL WHERE activation = '$code' AND id = '$id'";
        $dtb = new database();
        $dtb->execute($sql);
    }

    function drop_resetActivation_event($id)
    {
        $sql = "DROP EVENT IF EXIST reset_activation_".$id;
        $dtb = new database();
        $dtb->execute($sql);
    }

    function forgot_mail($to_email, $to_name, $activation)
    {
        $subject = 'Lấy lại mật khẩu';
        $content =
            '<!DOCTYPE html>
                <html lang="vi">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Lấy lại mật khẩu</title>
                </head>
                <body>
                    <p>
                        Link thay đổi mật khẩu tài khoản của bạn.
                        <br/>
                        Hãy chắc chắn rằng bạn nhận được mail của chúng tôi và không chia sẻ nó cho bất cứ ai.</p>
                    <p>
                        <a href="http://localhost:8888/btoann.github.io/index.php?ctrl=account&act=forgot&code='.$activation.'">
                            '.$activation.'
                        </a>
                    </p>
                </body>
            </html>';

        $mailer = new mailer();
        $mailer->sendmail($to_email, $to_name, $subject, $content);
    }

?>

