<?php

    include_once '.system/lib/controller.php';

    class hotprice
    {
        public function sbs_chosen($limit)
        {
            $sql =
                'SELECT pr.id, pr.name, pr.price, pmt.type as type_pmt, pmt.discount, img.basename
                FROM (SELECT basename FROM product_images WHERE role = 1 AND id_product IN (18, 19) LIMIT 1) AS img,
                    products pr INNER JOIN promotions pmt ON pr.promotion = pmt.id
                        ORDER BY id limit '.$limit;
            $dtb = new database();
            return $dtb->query($sql);
        }
    }

    function search($txt)
    {
        $sql = 'SELECT pr.id, pr.name FROM products pr 
                    WHERE pr.name LIKE "%'.$txt.'%" LIMIT 20';
        // Thực thi
        return query($sql);
    }
?>