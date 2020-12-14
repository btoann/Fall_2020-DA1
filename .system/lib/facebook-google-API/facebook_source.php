<?php
    include 'Facebook/autoload.php';
    include('fbconfig.php');
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email']; // Optional permissions
    //$loginUrl = $helper->getLoginUrl('http://localhost:8888/btoann.github.io/.system/lib/facebook-google-API/fb-callback.php', $permissions);
    $loginUrl = $helper->getLoginUrl('http://localhost:8888/btoann.github.io/index.php?ctrl=account&act=signin&api=facebook', $permissions);
?>