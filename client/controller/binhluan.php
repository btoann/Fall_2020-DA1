<?php

    include '../model/ajax.php';

    if(isset($_POST['product']) && $_POST['product'])
    {
        $show_bl = show_bl($_POST['product']);
        if(is_array($show_bl))
        {
            $output = '';
            foreach ($show_bl as $bl)
            {
                $output .=
                '<p><span>'.$bl['id_user'].': </span><span>'.$bl['content'].': </span></p>';
            }
            echo $output;
        }
        else
        {
            echo '<span> Không tìm thấy comment!</span>';
        }
    }
    
?>