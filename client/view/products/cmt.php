<?php

    
    include_once '../../../.system/lib/controller.php';

    function capnhap_cmt( $noidung){
        $sql = "INSERT INTO comments (  content ) VALUES ( '$noidung' )";

        $dtb = new database();
        $dtb->execute($sql);
    }
        function show_cmt(){
            $sql = "select * from comments ";
    
            $conn = connect();  
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll(); 
        }
    
?>