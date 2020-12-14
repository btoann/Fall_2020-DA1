<?php
    ob_start();
    include 'seller/model/products.php';
    include 'seller/model/categories.php';
    include 'seller/model/promotions.php';
    include_once '.system/lib/boolean.php';

    $bool = new boolean();

    /*  Get dữ liệu Orders  */
    $basic_products = basic_products_show($_SESSION['sbs_id_seller']);
    $categories = getall_categories();
    $promotions = getall_promotions();

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
                    $id_seller = $_SESSION['sbs_id_seller'];
                    $price = $_POST['price'];
                    $promotion = $_POST['promotion'];
                    $description = $_POST['description'];

                    $last_id = 0;
                    if($bool->checkNull($name, $category, $price, $description) == true)
                    {
                        $last_id = insert_product($name, $category, $hashtag, $id_seller, $price, $promotion, $description);
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
                                $filename = md5($images['name'][$i]).'-'.time(); // ex: 5dab1961e93a7-1571494241
                                $extension = pathinfo($images['name'][$i], PATHINFO_EXTENSION); // ex: jpg
                                $basename = $filename.'.'.$extension; // ex: 5dab1961e93a7_1571494241.jpg

                                $target_file = $target_folder.$basename;
                                if(move_uploaded_file($images["tmp_name"][$i], $target_file))
                                {
                                    // Upload thành công
                                    $img_name = $name.' - #'.$i;
                                    insert_product_image($img_name, $last_id, $basename);
                                }
                            }
                        }
                        header('location: seller.php?ctrl=products');
                    }
                }
                $hashtags = category_hashtag(91);  // Mặc định khi hiển thị hashtag
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

            case 'delete':
                /*  Xoá sản phẩm  */
                if(isset($_POST['delete']) && $_POST['delete'])
                {
                    $choices = (isset($_POST['choices']) && $_POST['choices'] != NULL) ? implode(", ", $_POST['choices']) : NULL;
                    delete_product($choices);
                }
                include 'seller/view/products/'.$act.'.php';
                break;

            default:
                header('location: seller.php?ctrl=products');
                break;
        }
    }
    else
        include 'seller/view/products/index.php';

    ob_flush();
?>