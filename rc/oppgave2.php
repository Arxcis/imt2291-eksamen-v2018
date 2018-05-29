<?php

require_once "DB.php";
require_once "helper.php";


function postFartoyForm() {

    $navn   = $_POST['navn']   ?? badRequest404('navn');
    $fpv    = $_POST['fpv']    ?? badRequest404('fpv');
    $kamera = $_POST['kamera'] ?? badRequest404('kamera');

    $db = DB::getConnection();

    return DB::postFartoy(
        $db,
        $navn,
        $fpv,
        $kamera
    );

//   var_dump($id, $cellCount, $capacity, $maxDischarge, $date);
}

if (!empty($_POST)) {
    $insertedId = postFartoyForm();

    if (!$insertedId) {
        serverError500();
    }

    echo "inserted battery with id: " . $insertedId;
}

$twig = requireTwig();
echo $twig->render('oppgave2.html', array());
