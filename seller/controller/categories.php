<?php

    include '../model/ajax.php';

    if(isset($_POST['category_hastag']) && $_POST['category_hastag'])
    {
        $hashtags = category_hashtag($_POST['category_hastag']);
        if(is_array($hashtags))
        {
            $output = '';
            foreach ($hashtags as $hashtag)
            {
                $output .=
                '<input type="checkbox" id="" name="hashtag[]" value="'.$hashtag['id'].'">
                <label for="">'.$hashtag['name'].'</label>&ensp;';
            }
            echo $output;
        }
        else
        {
            echo '<span> Không tìm thấy hashtag!</span>';
        }
    }
    
?>