<?php

    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        ob_start();
        include_once '.system/lib/boolean.php';

        $bool = new boolean();

        if(isset($_GET['act']) && $_GET['act'])
        {
            $act = $_GET['act'];
            switch($act)
            {

                case 'search':
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
                    break;

                default:
                    break;
            }
        }

        ob_flush();
        
    }

?>