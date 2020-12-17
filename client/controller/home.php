<?php
    
    include_once '.system/lib/controller.php';

    if(isset($_GET['act']) && $_GET['act'] == 'home')
        include 'client/view/home/index.php';
    else
        include 'client/view/home/index.php';

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['search']) && $_POST['search'] == 'search')
        {
            include_once 'client/model/products.php';
            $search = search($_POST['search']);
            if(count($search) > 0)
            {
                $output = '';
                foreach ($search as $row)
                {
                    $output .= '<p><a href=index.php?ctrl=products&act=detail&id='.$row['id'].'>'.$row['name'].'</a></p>';
                }
                echo $output;
            }
            else
            {
                echo '<p class="search_notfound">Không tìm thấy từ khoá</p>';
            }
        }
    }

?>