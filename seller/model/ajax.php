<?php

    include_once '../../.system/lib/ajax.php';

    function category_hashtag($id)
    {
        $sql = 'SELECT id, name FROM category_hashtag WHERE id_category = '.$id;
        $dtb = new database();
        return $dtb->query($sql);
    }

?>