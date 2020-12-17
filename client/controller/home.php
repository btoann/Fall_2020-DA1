<?php
    
    include_once '.system/lib/controller.php';

    if(isset($_GET['act']) && $_GET['act'] == 'home')
        include 'client/view/home/index.php';
    else
        include 'client/view/home/index.php';


?>