<?php
    ob_start();
    include_once 'admin/model/promotions.php';
    include_once '.system/lib/boolean.php';

    $bool = new boolean();

    /*  Get dữ liệu Khuyến mãi  */
    $get_promotions = get_promotions();

    if(isset($_GET['act']) && $_GET['act'])
    {
        $act = $_GET['act'];
        switch($act)
        {

            case 'detail':
                /*  Chi tiết phân loại  */
                if(isset($_GET['id']) && $_GET['id'])
                {
                    $parent = get_category($_GET['id']);
                    $childrens = getChildren_categories($_GET['id']);
                }
                include 'admin/view/promotions/'.$act.'.php';
                break;

            case 'manage':
                /*  Quản lí phân loại  */
                if(isset($_GET['id']) && $_GET['id'])
                {
                    $category = get_category($_GET['id']);
                    $promotions = get_promotions($_GET['id']);
                }
                if(isset($_POST['update']) && $_POST['update'])
                {
                    $ids = (isset($_POST['ids']) && $_POST['ids']) ? $_POST['ids'] : NULL;
                    $names = (isset($_POST['names']) && $_POST['names']) ? $_POST['names'] : NULL;

                    $new_promotions = (isset($_POST['promotions']) && $_POST['promotions']) ? $_POST['promotions'] : NULL;
                    insert_category_promotions($new_promotions, $category['id']);

                    // Well: not done yet :((

                    if($bool->checkNull($ids, $names))
                    {
                        $current_promotions = get_promotions($_POST['category']);
                        foreach($ids as $id)
                        {
                            if(!in_array($id, $current_promotions['id']))
                            {
                                delete_hashtag($id);
                            }
                        }
                    }

                    echo
                        '<script>
                            swal("Thành công!", "Bạn đã thêm danh mục \"'.$name.'\"", "success").then(() => {
                                window.location.replace("admin.php?ctrl=promotions");
                                });
                        </script>';
                    //header('location: admin.php?ctrl=promotions');
                }
                include 'admin/view/promotions/'.$act.'.php';
                break;

            case 'insert':
                /*  Thêm Khuyến mãi  */
                if(isset($_POST['insert']) && $_POST['insert'])
                {
                    $name = (isset($_POST['name']) && $_POST['name']) ? $_POST['name'] : NULL;
                    $type = (isset($_POST['type'])) ? $_POST['type'] : NULL;
                    $discount = (isset($_POST['discount']) && $_POST['discount']) ? $_POST['discount'] : NULL;
                    $min = (isset($_POST['min']) && $_POST['min']) ? $_POST['min'] : NULL;
                    $max = (isset($_POST['max']) && $_POST['max']) ? $_POST['max'] : NULL;
                    $begin = (isset($_POST['begin']) && $_POST['begin']) ? $_POST['begin'] : NULL;
                    $end = (isset($_POST['end']) && $_POST['end']) ? $_POST['end'] : NULL;
                    $description = (isset($_POST['description']) && $_POST['description']) ? $_POST['end'] : NULL;
                    $last_id = 0;
                    if($bool->checkNull($name, $type, $discount, $min, $max, $begin, $end, $description))
                    {
                        $messenge = '';
                        $bool2 = true;
                        if($type == 1 || $type == 2)
                        {
                            if($type == 1 && $discount < 0 && $discount > 100)
                            {
                                $messenge .= '- Giá giảm yêu cầu: 0 - 100 (%)\n';
                                $bool2 = false;
                            }
                            if($type == 2 && $discount < 0)
                            {
                                $messenge .= '- Giá giảm phải lớn hơn 0\n';
                                $bool2 = false;
                            }
                        }
                        else
                        {
                            $messenge .= '- Loại giảm giá không hợp lệ\n';
                            $bool2 = false;
                        }
                        if($min < $max)
                        {
                            if($type == 2 && $discount < $min)
                            {
                                $messenge .= '- Giá tối thiểu phải nhỏ hơn hoặc bằng giá giảm\n';
                                $bool2 = false;
                            }
                            if($type == 2 && $discount > $max)
                            {
                                $messenge .= '- Giá tối đa phải lớn hơn hoặc bằng giá giảm\n';
                                $bool2 = false;
                            }
                        }
                        else
                        {
                            $messenge .= '- Giá tối thiểu phải lớn hơn giá tối đa\n';
                            $bool2 = false;
                        }
                        if($begin > $end)
                        {
                            $messenge .= '- Thời gian bắt đầu phải lớn hơn thời gian kết thúc\n';
                            $bool2 = false;
                        }

                        if($bool2 == true)
                        {
                            insert_promotion($name, $type, $_SESSION['sbs_user']['id'], $discount, $min, $max, $begin, $end, $description);
                            echo
                                '<script>
                                    swal("Thành công!", "Bạn đã thêm khuyến mãi \"'.$name.'\"", "success").then(() => {
                                        window.location.replace("admin.php?ctrl=promotions");
                                    });
                                </script>';
                        }
                        else
                            echo
                                '<script>
                                    swal("Lỗi!", "'.$messenge.'", "warning").then(() => {
                                        window.location.replace("admin.php?ctrl=promotions");
                                    });
                                </script>';
                        //header('location: admin.php?ctrl=promotions');
                    }
                }
                include 'admin/view/promotions/'.$act.'.php';
                break;
            
            case 'update':
                /*  Cập nhật danh mục  */
                if(isset($_POST['update']) && $_POST['update'])
                {
                    // Danh mục cha
                    $id = (isset($_POST['id']) && $_POST['id']) ? $_POST['id'] : NULL;
                    $parent = get_category($id);
                    if(!is_array($parent))
                    {
                        break;
                    }
                    $name = (isset($_POST['name']) && $_POST['name']) ? $_POST['name'] : NULL;
                    $active = (isset($_POST['active']) && $_POST['active']) ? $_POST['active'] : NULL;
                    if($bool->checkNull($id, $name, $active))
                    {
                        update_category($id, $name, $_SESSION['sbs_id'], $active);
                    }
                    $parent_width = get_widthCategory($id);

                    // Danh mục con
                    if($parent_width['width'] > 1)
                    {
                        $ids = (isset($_POST['ids']) && $_POST['ids']) ? $_POST['ids'] : NULL;
                        $names = (isset($_POST['names']) && $_POST['names']) ? $_POST['names'] : NULL;
                        $parents = (isset($_POST['parents'])) ? $_POST['parents'] : NULL;
                        $actives = (isset($_POST['actives'])) ? $_POST['actives'] : NULL;
                        if($bool->checkNull($ids, $names, $parents))
                        {
                            $success = false;
                            for($i = 0; $i < sizeof($ids); $i++)
                            {
                                $child_width = get_widthCategory($ids[$i]);
                                if(($child_width['lft'] > $parent_width['lft']) && ($child_width['rgt'] < $parent_width['rgt']))
                                {
                                    if($bool->checkNull($ids[$i], $names[$i], $parents[$i], $actives[$i]))
                                    {
                                        $success = true;
                                        if($parents[$i] == $id)
                                            update_category($ids[$i], $names[$i], $_SESSION['sbs_id'], $actives[$i]);
                                        else
                                            updateChildren_category($ids[$i], $names[$i], $_SESSION['sbs_id'], $parents[$i], $child_width['rgt'], $actives[$i]);
                                        
                                    }
                                }
                            }
                            //if($success == true) break;
                        }
                    }
                }
                if(isset($_GET['id']) && $_GET['id'] > 0)
                {
                    $parent = get_category($_GET['id']);
                    if(!is_array($parent))
                    {
                        header('location: admin.php?ctrl=promotions');
                    }
                    else
                    {
                        $childrens = getChildren_promotions($_GET['id']);
                    }
                }
                else
                    header('location: admin.php?ctrl=promotions');
                include 'admin/view/promotions/'.$act.'.php';
                break;

            case 'delete':
                /*  Xoá sản phẩm  */
                if(isset($_POST['delete']) && $_POST['delete'])
                {
                    $choices = (isset($_POST['choices']) && $_POST['choices'] != NULL) ? $_POST['choices'] : NULL;
                    if($choices != NULL)
                    {
                        delete_promotions($choices);
                        break;
                    }
                }
                if(isset($_GET['id']) && $_GET['id'] > 0)
                {
                    $parent = get_widthCategory($_GET['id']);
                    if(!is_array($parent) || $parent['width'] <= 1)
                    {
                        header('location: admin.php?ctrl=promotions&act=delete');
                    }
                    else
                    {
                        $childrens = getChildren_promotions($_GET['id']);
                    }
                }
                include 'admin/view/promotions/'.$act.'.php';
                break;

            default:
                header('location: admin.php?ctrl=promotions');
                break;
        }
    }
    else
        include 'admin/view/promotions/index.php';

    ob_flush();
?>

<!--  -->