<?php
  
    include_once 'connect.php';

    function getall_category()
    {
        $sql =
            'SELECT node.id, node.name, (COUNT(parent.name) - 1) AS depth
                FROM categories AS node,
                    categories AS parent
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            GROUP BY node.name
            ORDER BY node.lft';
        return query($sql);
    }

    $categories = getall_category();
    foreach ($categories as $category)
    {
        echo $category['name'];
    }
    echo '123';

?>