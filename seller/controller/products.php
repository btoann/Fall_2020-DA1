<?php
    ob_start();
    include 'seller/model/products.php';

    /*  Get dữ liệu Products  */
    $basic_products = basic_products_show($_SESSION['sbs_id']);

    if(isset($_GET['act']) && $_GET['act'])
    {
        $act = $_GET['act'];
        switch($act)
        {

            case 'insert':
                /*  Thêm sản phẩm  */
                if(isset($_POST['insert']) && $_POST['insert'])
                {
                    $check_null = true;

                    if(!empty($_POST['name']))
                        $name = $_POST['name'];
                    else $check_null = false;
                    $category = $_POST['category'];
                    $category_hashtag = $_POST['category_hashtag'];
                    $price = $_POST['price'];
                    /*
                    $image = $_FILES['image']['name'];
                    $target_file = '.public/products/p_'.$id.'/'.basename($image);
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                    {
                        // Upload thành công
                    }
                    else
                        // Lỗi khi upload
                        $check_null = false;
                    */
                    $description = $_POST['description'];

                    if($check_null == true)
                    {
                        insert_product($name, $category, $category_hashtag, $price, $description);
                        header('location: seller.php?ctrl=products');
                    }
                }
                include 'seller/view/products/'.$act.'.php';
                break;
            
            case 'edit':
                /*  Chỉnh sửa sản phẩm  */
                if(isset($_POST['edit']) && $_POST['edit'])
                {
                    $check_null = true;

                    $id = $_POST['id'];
                    if(!empty($_POST['name']))
                        $name = $_POST['name'];
                    else $check_null = false;
                    $category = $_POST['category'];
                    $category_hashtag = $_POST['category_hashtag'];
                    $price = $_POST['price'];
                    /*
                    $image = $_FILES['image']['name'];
                    $target_file = '.public/products/p_'.$id.'/'.basename($image);
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                    {
                        // Upload thành công
                    }
                    else
                        // Lỗi khi upload
                        $check_null = false;
                    */
                    $description = $_POST['description'];

                    if($check_null == true)
                    {
                        update_product($name, $category, $category_hashtag, $price, $description);
                        header('location: seller.php?page=product');
                    }
                }
                include 'seller/view/products/'.$act.'.php';
                break;

            case 'del':
                /*  Xoá sản phẩm  */
                if(isset($_POST['del_choice']) && $_POST['del_choice'] > 0)
                {
                    delete_product($_POST['del_choice']);
                }
                header('location: seller.php?page=product');
                break;

            default:
                header('location: seller.php?page=product');
                break;
        }
    }
    else
        include 'seller/view/products/index.php';

    ob_flush();
?>