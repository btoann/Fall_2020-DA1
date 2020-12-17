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
            /* Tìm kiếm sản phẩm theo tên + tác giả + nxb,
                        tác giả theo tên  */
        $sql = 'SELECT sp.id, sp.name, "sanpham" as source 
                    FROM sanpham sp INNER JOIN nhaxuatban nxb ON sp.id_publisher = nxb.id 
                                    INNER JOIN tacgia tg ON sp.id_author = tg.id 
                WHERE sp.name LIKE "%'.$txt.'%" OR nxb.name LIKE "%'.$txt.'%" OR tg.name LIKE "%'.$txt.'%"';
        $sql .= ' UNION SELECT id, name, "tacgia" as table_name FROM tacgia tg WHERE tg.name LIKE "%'.$txt.'%"';
        $sql .= ' LIMIT 20';
        // Thực thi
        return query($sql);
    }
?>