<?php
include './Facebook/autoload.php';
include('./fbconfig.php');
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/fall2020/login/lesson-5/fb-callback.php', $permissions);
?>