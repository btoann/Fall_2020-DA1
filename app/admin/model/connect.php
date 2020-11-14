<?php

    function connect()
    {
        $host = 'fdb28.awardspace.net';
        $dbname = '3651421_sidebyside';
        $username = '3651421_sidebyside';
        $password = 'PRO1014_fall2020';
        
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        //tao doi tuong lop PDO
        $DBH = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password, $options);
        return $DBH;
    }

    function query($sql)
    {
        $conn = connect();
        // Thực thi
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // Kết quả trả về
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    function queryOne($sql)
    {
        $conn = connect();
        // Thực thi
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // Kết quả trả về
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    function execute($sql)
    {
        $conn = connect();
        $conn->exec($sql);
    }

?>