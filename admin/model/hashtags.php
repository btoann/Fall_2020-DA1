<?php
  
    include_once '.system/lib/controller.php';

    function get_hashtags($id_category)
    {
        $sql =
            'SELECT * FROM category_hashtag WHERE id_category = '.$id_category;
        $dtb = new database();
        return $dtb->query($sql);
    }
    
    function delete_hashtag($id)
    {
        $sql =
            'DELETE FROM category_hashtag WHERE id = '.$id;
        $dtb = new database();
        $dtb->execute($sql);
    }

?>