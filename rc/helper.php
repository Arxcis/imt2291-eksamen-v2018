<?php

require_once __DIR__ . "/vendor/autoload.php";


function echoline($line) {
    echo "<h4>" . $line . "</h4> " ;
}

function badRequest404($key) {
    echoline("ERROR - Bad Request 404. Missing: " . $key);
    die();
}

function serverError500() {
    echoline("ERROR - Server Error 500");
}


function requireTwig() {
    $loader = new Twig_Loader_Filesystem(__DIR__ . "/template");
    return new Twig_Environment($loader, array(
    //    'cache' => './compilation_cache',
    ));
}
