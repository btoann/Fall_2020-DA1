<?php
 
    include_once '.system/lib/controller.php';

    function count_products($id)
    {
        $sql =
            'SELECT count(id) as count FROM products WHERE id_seller = '.$id;
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function basic_products_show($id_user)
    {
        $sql =
            'SELECT pt.id, pt.name as product_name, ct.name as category_name, date, price as old_price, purchase
            FROM products pt INNER JOIN categories ct ON pt.id_category = ct.id
                            WHERE pt.id_seller = '.$id_user;
        $dtb = new database();
        return $dtb->query($sql);
    }

?>