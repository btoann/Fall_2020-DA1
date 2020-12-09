<?php
    ob_start();
    include_once 'admin/model/promotions.php';
    include_once '.system/lib/boolean.php';

    $bool = new boolean();

    /*  Get dữ liệu Danh mục  */
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
                /*  Thêm phân loại  */
                if(isset($_POST['insert']) && $_POST['insert'])
                {
                    $name = (isset($_POST['name']) && $_POST['name']) ? $_POST['name'] : NULL;
                    $parent = (isset($_POST['parent'])) ? $_POST['parent'] : NULL;
                    $last_id = 0;
                    if($bool->checkNull($name, $parent))
                    {
                        $last_id = insert_category($name, $parent, $_SESSION['sbs_id']);
                        if($parent > 0)
                        {
                            $last_id = $last_id->lastInsertId();
                            if(isset($_POST['check_hashtag']) && $_POST['check_hashtag'])
                            {
                                $promotions = $bool->array_removeNull($_POST['promotions']);
                                if($promotions != NULL)
                                    insert_category_promotions($promotions, $last_id);
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