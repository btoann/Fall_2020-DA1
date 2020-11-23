<?php
    ob_start();
    include 'seller/model/products.php';
    include 'seller/model/categories.php';
    include_once '.system/lib/boolean.php';

    $bool = new boolean();

    /*  Get dữ liệu Products  */
    $basic_products = basic_products_show($_SESSION['sbs_id']);
    $categories = getall_categories();

    if(isset($_GET['act']) && $_GET['act'])
    {
        $act = $_GET['act'];
        switch($act)
        {

            case 'insert':
                /*  Thêm sản phẩm  */
                if(isset($_POST['insert']) && $_POST['insert'])
                {
                    $name = $_POST['name'];
                    $category = $_POST['category'];
                    $hashtag = (isset($_POST['hashtag']) && $_POST['hashtag'] != NULL) ? implode(", ", $_POST['hashtag']) : NULL;
                    $id_seller = $_SESSION['sbs_id'];
                    $price = $_POST['price'];
                    $description = $_POST['description'];

                    $last_id = 0;
                    if($bool->checkNull($name, $category, $price, $description) == true)
                    {
                        $last_id = insert_product($name, $category, $hashtag, $id_seller, $price, $description);
                        $last_id = $last_id->lastInsertId();

                        if(isset($_FILES['image']))
                        {
                            $target_folder = '.public/images/products/p_'.$last_id.'/';
                            if(!file_exists($target_folder))
                            {
                                // Tạo 1 folder mới nếu nó chưa tồn tại
                                mkdir($target_folder, 0777, true);
                            }
                            $images = $_FILES['image'];
                            for($i = 0; $i <= sizeof($images); $i++)
                            {
                                $target_file = $target_folder.basename($images['name'][$i]);
                                if(move_uploaded_file($images["tmp_name"][$i], $target_file))
                                {
                                    // Upload thành công
                                    echo 'successfully!';
                                }
                            }
                        }
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