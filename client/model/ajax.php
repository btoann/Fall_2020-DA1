<?php

    include_once '../../.system/lib/ajax.php';

    function show_bl($id_product)
    {
        $sql = 'SELECT * from comments WHERE id_product = '.$id_product;
        $dtb = new database();
        return $dtb->query($sql);
    }

?>