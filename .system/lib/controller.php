<?php

    include_once '.system/core/connect.php';

    function event_scheduler($cmd)
    {
        $conn = connect();
        if($cmd == 'on' || $cmd == 'off')
        {
            $sql = "SET GLOBAL event_scheduler = '$cmd';";
            $conn->exec($sql);
        }
    }
    
    class database
    {

        public function query($sql)
        {
            $conn = connect();
            // Thực thi
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            // Kết quả trả về
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        }

        public function queryOne($sql)
        {
            $conn = connect();
            // Thực thi
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            // Kết quả trả về
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetch();
        }

        public function execute($sql)
        {
            $conn = connect();
            $conn->exec($sql);
        }
        
        public function getExec($sql)
        {
            $conn = connect();
            $conn->exec($sql);
            return $conn;
        }

    }

?>