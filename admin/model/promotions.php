<?php
  
    include_once '.system/lib/controller.php';

    function get_promotions()
    {
        $sql =
            'SELECT * FROM promotions ORDER BY id desc';
        $dtb = new database();
        return $dtb->query($sql);
    }
    
    function get_promotion($id)
    {
        $sql =
            'SELECT * FROM promotions WHERE id = '.$id;
        $dtb = new database();
        return $dtb->queryOne($sql);
    }

    function insert_promotion($name, $type, $id_admin, $discount, $min, $max, $begin, $end, $description, $active)
    {
        $sql =
            'INSERT INTO promotions(name, type, id_admin, discount, min, max, begin, end, description, active)
                    VALUES("'.$name.'", "'.$type.'", "'.$id_admin.'", "'.$discount.'", "'.$min.'", "'.$max.'", "'.$begin.'", "'.$end.'", "'.$description.'", "'.$active.'")';
        $dtb = new database();
        $dtb->execute($sql);
    }

    function update_promotion($id, $name, $type, $id_admin, $discount, $min, $max, $begin, $end, $description, $active)
    {
        $sql =
            "UPDATE promotions SET name = '$name', type = '$type', id_admin = '$id_admin', discount = '$discount', min = '$min', max = '$max',
                                    begin = '$begin', end = '$end', description = '$description', active = '$active'
                WHERE id = '$id'";
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