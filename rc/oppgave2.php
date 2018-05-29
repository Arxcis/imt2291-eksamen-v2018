<?php

require_once __DIR__ . "/DB.php";
require_once __DIR__ . "/helper.php";


function postFartoyForm() {

    $navn   = $_POST['navn']   ?? badRequest404('navn');
    $fpv    = $_POST['fpv']    ? true: false;
    $kamera = $_POST['kamera'] ? true: false;

    $db = DB::getConnection();

    return DB::postFartoy(
        $db,
        $navn,
        $fpv,
        $kamera
    );

}

if (!empty($_POST)) {
    $insertedId = postFartoyForm();

    if (!$insertedId) {
        serverError500();
        echoline('Could not insert fartoy into database (!$insertedId)');
    } else {
        echoline("Inserted battery with id: " . $insertedId);
    }
}

$twig = requireTwig();
echo $twig->render('oppgave2.html', array());
