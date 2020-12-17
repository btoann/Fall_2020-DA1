<?php
    ob_start();
    include 'client/model/account.php';
    include_once '.system/lib/boolean.php';

    $bool = new boolean();

    if(isset($_GET['act']) && $_GET['act'])
    {
        $act = $_GET['act'];
        switch($act)
        {

            case 'signin':
                if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
                    header('location: index.php');
                if(isset($_POST['signin']) && isset($_POST['signin']))
                {
                    $user = (isset($_POST['username']) && $_POST['username']) ? $_POST['username'] : NULL;
                    $pass = (isset($_POST['password']) && $_POST['password']) ? $_POST['password'] : NULL;
                    if($bool->checkNull($user, $pass))
                    {
                        $this_acc = signin($user);
                        if(is_array($this_acc))
                        {
                            if(password_verify($pass, $this_acc['pass']))
                            {
                                $_SESSION['sbs_user'] = $this_acc;
                                unset($_SESSION['sbs_user']['pass']);
                                
                                if(isset($_SESSION['forgot_send'])) unset($_SESSION['forgot_send']);

                                $url = ($_SESSION['sbs_user']['role'] >= 30) ? 'admin.php' : 'index.php';
                                header('location: '.$url);
                            }
                        }
                        
                        echo
                            '<script>
                                swal("Tài khoản hoặc mật khẩu không chính xác", "Vui lòng thử lại!", "warning").then(() => {
                                    $("#username").val("'.$user.'");
                                });
                            </script>';
                    }
                }
                if(isset($_GET['api']) && $_GET['api'])
                {
                    $api = $_GET['api'];
                    switch($api)
                    {
                        case 'facebook':
                            include '.system/lib/facebook-google-API/fb-callback.php';
                            break;
                        case 'google':
                            include '.system/lib/facebook-google-API/google_source.php';
                            break;
                        default:
                            header('location: index.php?ctrl=account&act=signin');
                            break;
                    }
                    break;
                }
                include 'client/view/account/'.$act.'.php';
                break;

            case 'signup':
                if(isset($_POST['signup']) && isset($_POST['signup']))
                {
                    $email = (isset($_POST['email']) && $_POST['email']) ? $_POST['email'] : NULL;
                    $tel = (isset($_POST['tel']) && $_POST['tel']) ? $_POST['tel'] : NULL;
                    $name = (isset($_POST['name']) && $_POST['name']) ? $_POST['name'] : NULL;
                    $pass = (isset($_POST['pass']) && $_POST['pass']) ? $_POST['pass'] : NULL;
                    $confirm_pass = (isset($_POST['confirm_pass']) && $_POST['confirm_pass']) ? $_POST['confirm_pass'] : NULL;
                    if($bool->checkNull($email, $tel, $name, $pass, $confirm_pass))
                    {
                        if($pass == $confirm_pass)
                        {
                            // Email's regex
                            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
                            if(preg_match($regex, $email))
                            {
                                $test_email = signin($email);
                                $test_tel = signin($tel);
                                if(!(is_array($test_email) && is_array($test_tel)))
                                {
                                    // Mã hoá mật khẩu
                                    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                                    signup($name, $email, $tel, $hashed_password);

                                    $acc = signin($email);
                                    $_SESSION['sbs_user'] = $acc;

                                    // Tạo mã xác thực
                                    $activation = create_activation($_SESSION['sbs_user']['id'], $_SESSION['sbs_user']['email']);

                                    // Gửi mail xác thực
                                    verify_mail($_SESSION['sbs_user']['email'], $_SESSION['sbs_user']['name'], $_SESSION['sbs_user']['id'], $activation);

                                    $url = ($acc['role'] >= 30) ? 'admin.php' :
                                            (($acc['role'] < 30 ) ? 'index.php?ctrl=account&act=user&id='.$acc['id'] : 'index.php');
                                    header('location: '.$url);
                                }
                                else
                                {
                                    $value = (is_array($test_email) && is_array($test_tel))
                                            ? 'email và số điện thoại'
                                            : ((!is_array($test_email) && is_array($test_tel))
                                                ? 'số điện thoại' : ((is_array($test_email) && !is_array($test_tel))
                                                                    ? 'email' : ''));
                                    echo
                                        '<script>
                                            swal("'.ucfirst($value).' đã tồn tại!", "Vui lòng thử nhập '.$value.' khác", "warning").then(() => {
                                                $("#name").val("'.$name.'");
                                                $("#email").val("'.$email.'");
                                                $("#tel").val("'.$tel.'");
                                            });
                                        </script>';
                                }
                            }
                        }
                        else
                            echo
                                '<script>
                                    swal("Mật khẩu xác nhận không khớp", "Vui lòng thử lại", "warning").then(() => {
                                        $("#name").val("'.$name.'");
                                        $("#email").val("'.$email.'");
                                        $("#tel").val("'.$tel.'");
                                    });
                                </script>';
                    }
                }
                include 'client/view/account/'.$act.'.php';
                break;

            case 'signout':
                if(isset($_SESSION['sbs_user']))
                    unset($_SESSION['sbs_user']);
                if(isset($_SESSION['access_token']))
                    unset($_SESSION['access_token']);
                header('location: index.php');
                break;
            
            case 'user':
                if(isset($_GET['id']) && $_GET['id'])
                {
                    if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
                    {
                        if(($_SESSION['sbs_user']['id'] == $_GET['id']))
                        {
                            if($_SESSION['sbs_user']['role'] == 0)
                            {
                                if(isset($_GET['verify']) && $_GET['verify'])
                                {
                                    if(is_array(get_verify($_GET['id'], $_GET['verify'])))
                                    {
                                        $new_role = verify_account($_GET['id'], $_GET['verify']);
                                        $_SESSION['sbs_user']['role'] = $new_role;
                                    }
                                }
                                if(isset($_POST['resend_verify']) && $_POST['resend_verify'])
                                {
                                    $activation = create_activation($_SESSION['sbs_id'], $_SESSION['sbs_email']);
                                    verify_mail($_SESSION['sbs_user']['email'], $_SESSION['sbs_user']['name'], $_SESSION['sbs_user']['id'], $activation);
                                    header('location: index.php?ctrl=account&act=user&id='.$_GET['id']);
                                }
                                if($_SESSION['sbs_user']['role'] > 0)
                                {
                                    header('location: index.php');
                                }
                            }
                        }
                    }
                }
                else
                    header('location: index.php');
                include 'client/view/account/'.$act.'.php';
                break;

            case 'forgot':
                if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
                    header('location: index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id']);
                if(isset($_POST['forgot']) && $_POST['forgot'])
                {
                    $email = (isset($_POST['email']) && $_POST['email']) ? $_POST['email'] : NULL;
                    $this_acc = signin($email);
                    if(is_array($this_acc))
                    {
                        $timestamp = isset($_SESSION['forgot_send'])
                            ? $_SESSION['forgot_send']['time']
                            : NULL;
                        if(!$bool->checkNull($timestamp) || (time() - $timestamp) > (1 * 60))
                        {
                            $_SESSION['forgot_send'] = array('id' => $this_acc['id'], 'email' => $this_acc['email'], 'time' => time());
                            // Tạo mã xác nhận
                            $activation = create_activation(0, $this_acc['email']);
                            // Đặt thời gian reset mã xác nhận (5')
                            reset_activation($this_acc['id'], $activation);
                            // Tạo mail xác nhận
                            forgot_mail($this_acc['email'], $this_acc['name'], $activation);
                            echo
                                '<script>
                                    swal("Thành công", "Mã đã được gửi, hết hiệu lực sau 5 phút", "success");
                                </script>';
                        }
                        else
                            echo
                                '<script>
                                    swal("Yêu cầu bị từ chối!", "Bạn cần ít nhất 1 phút sau lần gửi mail cuối cùng để tiếp tục yêu cầu", "warning");
                                </script>';
                    }
                    else
                        echo
                            '<script>
                                swal("Tài khoản \''.$email.'\' không tồn tại", "Vui lòng thử lại!", "warning").then(() => {
                                    $("#email").val("'.$email.'");
                                });
                            </script>';
                }
                if(isset($_GET['new']) && $_GET['new'])
                {
                    if(isset($_SESSION['forgot_send']))
                        unset($_SESSION['forgot_send']);
                    header('location: index.php?ctrl=account&act=forgot');
                }
                $sent = false;
                if(isset($_SESSION['forgot_send']))
                {
                    if(isset($_GET['code']) && $_GET['code'])
                    {
                        $code = $_GET['code'];
                        $account = signin($_SESSION['forgot_send']['email']);
                        if(is_array($account))
                        {
                            if($code == $account['activation'])
                            {
                                $sent = true;
                                if(isset($_POST['reset']) && $_POST['reset'])
                                {
                                    $pass = (isset($_POST['pass']) && $_POST['pass']) ? $_POST['pass'] : NULL;
                                    $confirm_pass = (isset($_POST['confirm_pass']) && $_POST['confirm_pass']) ? $_POST['confirm_pass'] : NULL;
                                    $signin = (isset($_POST['signin'])) ? $_POST['signin'] : NULL;
                                    if($bool->checkNull($pass, $confirm_pass))
                                    {
                                        if($pass == $confirm_pass)
                                        {
                                            // Mã hoá mật khẩu
                                            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                                            // Nhận mật khẩu mới
                                            reset_password($_SESSION['forgot_send']['id'], $code, $hashed_password);
                                            // Huỷ sự kiện reset mã xác nhận
                                            drop_resetActivation_event($_SESSION['forgot_send']['id']);
                                            unset($_SESSION['forgot_send']);

                                            $url = 'index.php?ctrl=account&signin';
                                            if($bool->checkNull($signin))
                                            {
                                                $url = 'index.php';
                                                $_SESSION['sbs_user'] = $account;
                                                unset($_SESSION['sbs_user']['pass']);
                                            }
                                            echo
                                                '<script>
                                                    swal("Thành công", "Bạn đã đổi thành công mật khẩu của mình", "success").then(() => {
                                                        window.location.replace("'.$url.'");
                                                    });
                                                </script>';
                                        }
                                        else
                                            echo
                                                '<script>
                                                    swal("Mật khẩu xác nhận không khớp", "Vui lòng thử lại", "warning");
                                                </script>';
                                    }
                                }
                            }
                            else
                                header('location: index.php?ctrl=account&act=forgot');
                        }
                    }
                }
                include 'client/view/account/'.$act.'.php';
                break;

            default:
                if(isset($_SESSION['sbs_user']))
                    include 'client/view/account/home.php';
                else
                    include 'client/view/account/signin.php';
                break;
        }
    }
    else
        header('location: index.php');
    ob_end_flush();
?>