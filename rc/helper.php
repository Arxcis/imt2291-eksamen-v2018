<?php

require_once "vendor/autoload.php";

function badRequest404($key) {

    echo "ERROR - Bad Request 404. Missing: " . $key;
    die();
}

function serverError500() {

    echo "ERROR - Server Error";
    die();   
}


function requireTwig() {
    $loader = new Twig_Loader_Filesystem("template");
    return new Twig_Environment($loader, array(
    //    'cache' => './compilation_cache',
    ));
}
