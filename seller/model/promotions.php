<?php

    include_once '.system/lib/controller.php';

    function getall_promotions()
    {
        $sql =
            'SELECT * FROM promotions ORDER BY id desc';
        $dtb = new database();
        return $dtb->query($sql);
    }

    function get_promotion($id)
    {
        $sql =
            'SELECT * FROM promotions WHERE id='.$id;
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

?>