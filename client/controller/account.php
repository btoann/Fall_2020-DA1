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
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $this_acc = signin($user);
                    if(is_array($this_acc))
                    {
                        if(password_verify($pass, $this_acc['pass']))
                        {
                            $_SESSION['sbs_user'] = $this_acc;

                            $url = ($_SESSION['sbs_user']['role'] >= 30) ? 'admin.php' :
                                    (($_SESSION['sbs_user']['role'] < 30) ? 'index.php?ctrl=account&act=user&id='.$_SESSION['sbs_user']['id'] : 'index.php');
                            header('location: '.$url);
                        }
                    }
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
                            if(!is_array(signin($email)) && !is_array(signin($tel)))
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
                        }
                    }
                }
                include 'client/view/account/'.$act.'.php';
                break;

            case 'signout':
                unset($_SESSION['sbs_user']);
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