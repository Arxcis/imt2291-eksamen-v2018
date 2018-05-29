<?php

require_once __DIR__ . "/DB.php";
require_once __DIR__ . "/helper.php";



$db = DB::getConnection();

$fartoyArray  = DB::getAllFartoy($db);

$twig = requireTwig();
echo $twig->render(
    'oppgave4.html', 
    array(
        'fartoyArray'  => $fartoyArray
    )
);
