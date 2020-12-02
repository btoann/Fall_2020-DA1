<?php
  
    include_once '.system/lib/controller.php';

    function getall_category()
    {
        $sql =
            'SELECT node.id, node.name, (COUNT(parent.name) - 1) AS depth
                FROM categories AS node,
                    categories AS parent
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            GROUP BY node.name
            ORDER BY node.lft';
        return $dtb->query($sql);
    }

?>
