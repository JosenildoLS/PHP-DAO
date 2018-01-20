<?php

// Faz os requires automaticamente
spl_autoload_register(function($nameClass) {

    $dirClass = "class";
    $filename = $dirClass . DIRECTORY_SEPARATOR . $nameClass . ".php";

//    var_dump($filename);

    if (file_exists($filename)) {
        require_once($filename);
    }
});
