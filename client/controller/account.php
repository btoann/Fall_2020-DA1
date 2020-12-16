<?php
    ob_start();
    include 'client/model/account.php';

    if(isset($_GET['act']) && $_GET['act'])
    {
        $act = $_GET['act'];
        switch($act)
        {

            case 'signin':
                if(isset($_POST['signin']) && isset($_POST['signin']))
                {
                    $user = $_POST['username'];
                    $pass = $_POST['password'];
                    $this_acc = signin($user);
                    if(is_array($this_acc))
                    {
                        if(password_verify($pass, $this_acc['pass']))
                        {
                            $_SESSION['sbs_user'] = $this_acc;
                            unset($_SESSION['sbs_user']['pass']);

                            $url = ($_SESSION['sbs_user']['role'] >= 30) ? 'admin.php' :
                                    (($_SESSION['sbs_user']['role'] < 30) ? 'index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id'] : 'index.php');
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
                if(isset($_SESSION['sbs_user']) && $_SESSION['sbs_user']['id'] > 0)
                    header('location: index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id']);
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
                    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['pass']))
                    {
                        $email = $_POST['email'];
                        $tel = $_POST['tel'];
                        // Email's regex
                        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
                        if(preg_match($regex, $email))
                        {
                            $test_email = signin($email);
                            $test_tel = signin($tel);
                            if(!is_array($test_email) && !is_array($test_tel))
                            {
                                $name = $_POST['name'];
                                $pass = $_POST['pass'];
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
                                $value = '';
                                if(!is_array($test_email) && !is_array($test_tel))
                                {
                                    $value = 'email và số điện thoại';
                                }
                                else
                                {
                                    if(is_array($test_email) && !is_array($test_tel))
                                    {
                                        $value = 'số điện thoại';
                                    }
                                    if(!is_array($test_email) && is_array($test_tel))
                                    {
                                        $value = 'email';
                                    }
                                }
                                echo
                                    '<script>
                                        swal("'.ucfirst($value).' đã tồn tại!", "Vui lòng thử nhập '.$value.' khác", "warning").then(() => {
                                            $(".form-signin").toggleClass("form-signin-left");
                                            $(".form-signup").toggleClass("form-signup-left");
                                            $(".frame").toggleClass("frame-long");
                                            $(".signup-inactive").toggleClass("signup-active");
                                            $(".signin-active").toggleClass("signin-inactive");
                                            $(".forgot").toggleClass("forgot-left");
                                            $(this).removeClass("idle").addClass("active");
                                            $("#user_login").toggleClass("p-tb-30-i");
                                        });
                                    </script>';
                            }
                        }
                    }
                }
                include 'client/view/account/signin.php';
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

            case 'verify':
                // $messenge = '';
                // if(isset($_GET['code']) && !empty($_GET['code']))
                // {
                //     $code = $_GET['code'];
                //     $acc = get_verify($code);
                //     if(is_array($acc))
                //     {
                //         if($acc['role'] == 0)
                //         {
                //             verify_account($code);
                //             $messenge = 'Kích hoạt thành công';
                //         }
                //         else
                //             $messenge = 'Tài khoản của bạn đã được kích hoạt';
                //     }
                //     else
                //         header('location: index.php?ctrl=acc&act=user');
                //     echo 
                //         '<script defer>
                //             $(document).ready( () => {
                //                 $("#messenge").html("'.$messenge.'");
                //             });
                //         </script>';
                // }
                // else header('location: index.php?ctrl=acc&act=signin');
                // include 'view/client/acc/'.$act.'.php';
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