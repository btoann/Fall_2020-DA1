<?php
  
    include_once '.system/lib/controller.php';

    function get_category($id)
    {
        $sql =
            'SELECT categories.id, categories.name, users.name as creator,
                    DATE_FORMAT(categories.date, "%d/%m/%Y") as date, categories.active
                FROM categories INNER JOIN users ON categories.id_admin = users.id
            WHERE categories.id = '.$id;
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function get_widthCategory($id)
    {
        $sql = 'SELECT id, lft, rgt, (rgt - lft) as width FROM categories WHERE id = '.$id;
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function getParent_categories()
    {
        $sql =
            'SELECT node.id, node.name, users.name as creator, DATE_FORMAT(node.date, "%d/%m/%Y") as date,
                    (COUNT(parent.name) - 1) AS depth, (node.rgt - node.lft) as width, node.active
                FROM 
                    categories AS parent,
                    categories AS node INNER JOIN users ON node.id_admin = users.id
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
            "SELECT node.id, node.name, users.name as creator, DATE_FORMAT(node.date, '%d/%m/%Y') as date,
                    (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth, node.active
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
                    categories AS node INNER JOIN users ON node.id_admin = users.id
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
    
    function insert_category($name, $parent, $id_admin)
    {
        $sql = ($parent > 0)
            ?
                "LOCK TABLE categories WRITE;

                SELECT @myLeft := lft FROM categories
                
                WHERE id = ".$parent.";
                
                UPDATE categories SET rgt = rgt + 2 WHERE rgt > @myLeft;
                UPDATE categories SET lft = lft + 2 WHERE lft > @myLeft;
                
                UNLOCK TABLES;

                INSERT INTO categories(name, id_admin, lft, rgt) VALUES('".$name."', '".$id_admin."', @myLeft + 1, @myLeft + 2);"
            :
                "LOCK TABLE categories WRITE;

                SELECT @max_rgt := MAX(rgt) FROM categories;
                
                INSERT INTO categories(name, id_admin, lft, rgt) VALUES('".$name."', '".$id_admin."', @max_rgt + 1, @max_rgt + 2);
                
                UNLOCK TABLES;";
        $dtb = new database();
        return $dtb->getExec($sql);
    }

    function insert_category_hashtags($hashtags, $id_category)
    {
        $values = array();
        foreach($hashtags as $hashtag)
        {
            array_push($values, '("'.$hashtag.'", '.$id_category.')');
        }
        $sql =
            'INSERT INTO category_hashtag (name, id_category)
            VALUES '.implode(', ', $values);
        $dtb = new database();
        $dtb->execute($sql);
    }

    function update_category($id, $name, $id_admin, $active)
    {
        $sql = "UPDATE categories SET name = '$name', id_admin = '$id_admin', date = current_timestamp(), active = '$active'
                    WHERE id = '$id'";
        $dtb = new database();
        $dtb->execute($sql);
    }

    function updateChildren_category($id, $name, $id_admin, $id_parent, $rgt, $active)
    {
        $sql =
            "LOCK TABLE categories WRITE;

            SELECT @parentLeft := lft
                FROM categories WHERE id = '$id_parent';
            
            UPDATE categories SET rgt = rgt + 2 WHERE rgt > @parentLeft;
            UPDATE categories SET lft = lft + 2 WHERE lft > @parentLeft;

            UPDATE categories SET name = '$name', lft = @parentLeft + 1, rgt = @parentLeft + 2,
                                    id_admin = '$id_admin', date = current_timestamp(), active = '$active'
                                WHERE id = '$id';

            UPDATE categories SET rgt = rgt - 2 WHERE rgt > '$rgt';
            UPDATE categories SET lft = lft - 2 WHERE lft > '$rgt';

            UNLOCK TABLES;";
        $dtb = new database();
        $dtb->execute($sql);
    }

    function delete_categories($ids)
    {
        $sql = '';
        if(is_array($ids))
        {
            if(sizeof($ids) > 0)
                foreach($ids as $id)
                {
                    if($id > 0)
                        $sql .= 
                            "LOCK TABLE categories WRITE;

                            SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
                            FROM categories WHERE id = '$id';
                            
                            DELETE FROM categories WHERE lft = @myLeft AND @myRight;
                            
                            UPDATE categories SET rgt = rgt - @myWidth WHERE rgt > @myRight;
                            UPDATE categories SET lft = lft - @myWidth WHERE lft > @myRight;
                            
                            UNLOCK TABLES;";
                }
        }
        else
            if($ids > 0)
                $sql .= 
                    "LOCK TABLE categories WRITE;

                    SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
                    FROM categories WHERE id = '$id';
                    
                    DELETE FROM categories WHERE lft BETWEEN @myLeft AND @myRight;
                    
                    UPDATE categories SET rgt = rgt - @myWidth WHERE rgt > @myRight;
                    UPDATE categories SET lft = lft - @myWidth WHERE lft > @myRight;
                    
                    UNLOCK TABLES;";
        $dtb = new database();
        $dtb->execute($sql);
    }

?>