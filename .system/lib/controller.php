<?php

    include_once '../core/connect.php';

    class controller
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
    }

?>