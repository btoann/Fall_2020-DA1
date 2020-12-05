<?php
  
    include_once '.system/lib/controller.php';

    function get_category($id)
    {
        $sql =
            'SELECT categories.id, categories.name, users.name as creator, DATE_FORMAT(categories.date, "%d/%m/%Y") as date
                FROM categories INNER JOIN users ON categories.id_user = users.id
            WHERE categories.id = '.$id;
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function getParent_categories()
    {
        $sql =
            'SELECT node.id, node.name, users.name as creator, DATE_FORMAT(node.date, "%d/%m/%Y") as date,
                    (COUNT(parent.name) - 1) AS depth, (node.rgt - node.lft) AS leaf
                FROM 
                    categories AS parent,
                    categories AS node INNER JOIN users ON node.id_user = users.id
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            GROUP BY node.name
            HAVING depth = 0
            ORDER BY node.lft';
        $dtb = new database();
        return $dtb->query($sql);
    }
    
    function getChildren_categories($id)
    {
        $sql =
            "SELECT node.id, node.name, users.name as creator, DATE_FORMAT(node.date, '%d/%m/%Y') as date, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
                FROM
                    categories AS parent,
                    categories AS sub_parent,
                    (
                        SELECT node.name, (COUNT(parent.name) - 1) AS depth
                        FROM categories AS node,
                                categories AS parent
                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                AND node.id = '$id'
                        GROUP BY node.name
                        ORDER BY node.lft
                    ) AS sub_tree,
                    categories AS node INNER JOIN users ON node.id_user = users.id
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
                    AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
                    AND sub_parent.name = sub_tree.name
            GROUP BY node.name
            HAVING depth = 1
            ORDER BY node.lft";
        $dtb = new database();
        return $dtb->query($sql);
    }

    function count_product($id)
    {
        $sql =
            'SELECT COUNT(products.name) as among
                FROM categories INNER JOIN products ON products.id_category = categories.id
            WHERE products.id_category = categories.id AND categories.id = '.$id;
        $dtb = new database();
        return $dtb->queryOne($sql);
    }
    
    function insert_category($name, $parent)
    {
        $sql = ($parent > 0)
            ?
                "LOCK TABLE categories WRITE;

                SELECT @myLeft := lft FROM categories
                
                WHERE id = ".$parent.";
                
                UPDATE categories SET rgt = rgt + 2 WHERE rgt > @myLeft;
                UPDATE categories SET lft = lft + 2 WHERE lft > @myLeft;
                
                INSERT INTO categories(name, lft, rgt) VALUES('".$name."', @myLeft + 1, @myLeft + 2);
                
                UNLOCK TABLES;"
            :
                "LOCK TABLE categories WRITE;

                SELECT @max_rgt := MAX(rgt) FROM categories;
                
                INSERT INTO categories(name, lft, rgt) VALUES('".$name."', @max_rgt + 1, @max_rgt + 2);
                
                UNLOCK TABLES;";
        $dtb = new database();
        $dtb->getExec($sql);
    }

    function insert_category_hastag($name, $id_category)
    {
        $sql =
            'INSERT INTO category_hastag (name, id_product)
            VALUES ("'.$name.'", "'.$id_product.'")';
        $dtb = new database();
        $dtb->execute($sql);
    }

?>