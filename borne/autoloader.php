<?php

spl_autoload_register( function($class) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/Classes/';
    $class_name = substr($class,8);
    if($class_name){
        require_once  $path . $class_name .'.php';
    }
});

?>