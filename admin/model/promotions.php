<?php
  
    include_once '.system/lib/controller.php';

    function get_promotions()
    {
        $sql =
            'SELECT * FROM promotions ORDER BY id desc';
        $dtb = new database();
        return $dtb->query($sql);
    }
    
    function insert_promotion($name, $type, $id_admin, $discount, $min, $max, $begin, $end, $description)
    {
        $sql =
            'INSERT INTO promotions(name, type, id_admin, discount, min, max, begin, end, description)
                    VALUES("'.$name.'", "'.$type.'", "'.$id_admin.'", "'.$discount.'", "'.$min.'", "'.$max.'", "'.$begin.'", "'.$end.'", "'.$description.'")';
        $dtb = new database();
        $dtb->execute($sql);
    }

    function delete_promotion($id)
    {
        $sql =
            'DELETE FROM promotions WHERE id = '.$id;
        $dtb = new database();
        $dtb->execute($sql);
    }

?>