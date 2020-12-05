<?php
    ob_start();
    include_once 'admin/model/categories.php';
    include_once '.system/lib/boolean.php';

    $bool = new boolean();

    /*  Get dữ liệu Danh mục  */
    $getParent_categories = getParent_categories();

    if(isset($_GET['act']) && $_GET['act'])
    {
        $act = $_GET['act'];
        switch($act)
        {

            case 'detail':
                /*  Chi tiết danh mục  */
                if(isset($_GET['id']) && $_GET['id'] > 0)
                {
                    $parent = get_category($_GET['id']);
                    $childrens = getChildren_categories($_GET['id']);
                }
                include 'admin/view/categories/'.$act.'.php';
                break;

            case 'insert':
                /*  Thêm danh mục  */
                if(isset($_POST['insert']) && $_POST['insert'])
                {
                    $name = $_POST['name'];
                    $parent = $_POST['parent'];
                    $hashtags = $_POST['hashtags'];

                    $last_id = 0;
                    if($bool->checkNull($name) == true)
                    {
                        $last_id = insert_category($name, $parent);
                        $last_id = $last_id->lastInsertId();

                        for($i = 0; $i <= sizeof($hashtags); $i++)
                        {
                            insert_category_hastag($name, $last_id);
                        }
                        header('location: admin.php?ctrl=categories');
                    }
                }
                include 'admin/view/categories/'.$act.'.php';
                break;
            
            case 'edit':
                /*  Chỉnh sửa danh mục  */
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
                header('location: admin.php?ctrl=categories');
                break;
        }
    }
    else
        include 'admin/view/categories/index.php';

    ob_flush();
?>