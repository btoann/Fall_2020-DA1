<?php

    include_once '.system/lib/controller.php';

    function get_categories_0()
    {
        $sql =
            'SELECT node.id as id, node.name as name, (COUNT(parent.name) - 1) AS depth
            FROM categories AS node,
                    categories AS parent
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            GROUP BY node.name
            HAVING depth = 0
            ORDER BY node.rgt';
        $dtb = new database();
        return $dtb->query($sql);
    }

?>