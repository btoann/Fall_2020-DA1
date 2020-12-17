<?php

    include_once '.system/lib/controller.php';

    function getall_categories()
    {
        $sql =
            'SELECT node.id, node.name, (COUNT(parent.name) - 1) AS depth
                FROM categories AS node,
                    categories AS parent
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            GROUP BY node.name
            ORDER BY node.lft';
        $dtb = new database();
        return $dtb->query($sql);
    }
    
    function category_hashtag($id)
    {
        $sql = 'SELECT id, name FROM category_hashtag WHERE id_category = '.$id;
        $dtb = new database();
        return $dtb->query($sql);
    }

?>