<?php
    ob_start();
    include 'seller/model/account.php';

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
                    $this_seller = signin($user);
                    if(is_array($this_seller))
                    {
                        if(password_verify($pass, $this_seller['pass']))
                        {
                            $_SESSION['sbs_seller_id'] = $this_seller['id'];
                            $_SESSION['sbs_seller_name'] = $this_seller['name'];
                            $_SESSION['sbs_seller_email'] = $this_seller['email'];
                            $_SESSION['sbs_seller_tel'] = $this_seller['tel'];
                            $_SESSION['sbs_seller_role'] = $this_seller['role'];

                            header('location: seller.php');
                        }
                    }
                }
                if(isset($_SESSION['sbs_seller_id']) && $_SESSION['sbs_seller_id'] > 0)
                    header('location: seller.php?ctrl=account&act=user&id='.$_SESSION['sbs_seller_id']);
                include 'seller/view/account/'.$act.'.php';
                break;

            case 'signup':
                if(isset($_POST['signup']) && isset($_POST['signup']))
                {
                    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['address']) && !empty($_POST['pass']) && !empty($_POST['role']))
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
                                $address = $_POST['address'];
                                $role = $_POST['role'];
                                // Mã hoá mật khẩu
                                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                                signup($name, $email, $tel, $address, $hashed_password, $role);

                                $seller = signin($email);
                                $_SESSION['sbs_seller_id'] = $seller['id'];
                                $_SESSION['sbs_seller_name'] = $seller['name'];
                                $_SESSION['sbs_seller_email'] = $seller['email'];
                                $_SESSION['sbs_seller_tel'] = $seller['tel'];
                                $_SESSION['sbs_seller_address'] = $seller['address'];
                                $_SESSION['sbs_seller_role'] = $seller['role'];

                                // Tạo mã xác thực
                                $activation = create_activation($_SESSION['sbs_seller_id'], $_SESSION['sbs_seller_email']);

                                // Gửi mail xác thực
                                verify_mail($_SESSION['sbs_seller_email'], $_SESSION['sbs_seller_id'], $activation);

                                header('location: seller.php');
                            }
                        }
                    }
                }
                include 'seller/view/account/'.$act.'.php';
                break;

            case 'logout':
                unset($_SESSION['sbs_seller_id']);
                unset($_SESSION['sbs_seller_name']);
                unset($_SESSION['sbs_seller_email']);
                unset($_SESSION['sbs_seller_tel']);
                unset($_SESSION['sbs_seller_address']);
                unset($_SESSION['sbs_seller_role']);
                header('location: seller.php?ctrl=account&act=signin');
                break;
            
            case 'user':
                if(isset($_GET['id']) && $_GET['id'])
                {
                    if(isset($_SESSION['sbs_seller_id']) && $_SESSION['sbs_seller_id'] > 0)
                    {
                        if(($_SESSION['sbs_seller_id'] == $_GET['id']))
                        {
                            if($_SESSION['sbs_seller_role'] == 0)
                            {
                                if(isset($_GET['verify']) && $_GET['verify'])
                                {
                                    if(is_array(get_verify($_GET['id'], $_GET['verify'])))
                                    {
                                        verify_account($_GET['id'], $_GET['verify']);
                                    }
                                }
                                if(isset($_POST['resend_verify']) && $_POST['resend_verify'])
                                {
                                    $activation = create_activation($_SESSION['sbs_id'], $_SESSION['sbs_email']);
                                    verify_mail($_SESSION['sbs_email'], $_SESSION['sbs_id'], $activation);
                                    header('location: index.php?ctrl=account&act=user&id='.$_GET['id']);
                                }
                            }
                            if($_SESSION['sbs_seller_role'] > 0)
                            {
                                header('location: seller.php?ctrl=account&act=user&id='.$_GET['id']);
                            }
                        }
                    }
                }
                else
                    header('location: seller.php');
                include 'seller/view/account/'.$act.'.php';
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
                if(isset($_SESSION['sbs_seller_id']))
                    include 'seller/view/account/home.php';
                else
                    include 'seller/view/account/signin.php';
                break;
        }
    }
    else
        header('location: seller.php');
    ob_end_flush();
?>