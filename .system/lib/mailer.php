<?php

    include '.system/lib/PHPMailer/class.phpmailer.php';
    include '.system/lib/PHPMailer/class.smtp.php';
    include '.system/lib/PHPMailer/Exception.php';
    include '.system/lib/PHPMailer/OAuth.php';
    include '.system/lib/PHPMailer/PHPMailer.php';
    include '.system/lib/PHPMailer/POP3.php';
    include '.system/lib/PHPMailer/SMTP.php';

    class mailer
    {
        public function sendmail($to_email, $to_name, $subject, $content)
        {
            $mail = new PHPMailer(true);
            try
            {   
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail ->CharSet = "UTF-8";
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'shop.sidebyside@gmail.com';    // SMTP username
                $mail->Password   = 'sidebyside2020';     
                $mail->SMTPSecure = 'tls';      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;  

                $mail->setFrom('systemsbs@xxx.com', 'sidebyside.shop');
                $mail->addAddress($to_email, $to_name);  

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $content;

                $mail->send();
            }
            catch (Exception $e)
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

    }

?>