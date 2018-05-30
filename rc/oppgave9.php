<?php

require_once __DIR__ . "/DB.php";
require_once __DIR__ . "/helper.php";



function postBatteryStatusForm() {

    $batteryId   = $_POST['batteryid']  ?? badRequest404('batteryid');
    $fartoyId    = $_POST['fartoyid']   ?? badRequest404('fartoyid');
    $flightTime  = $_POST['flighttime'] ?? badRequest404('flighttime');
    $capacity    = $_POST['capacity']   ?? badRequest404('capacity');
    $date        = $_POST['date']       ?? badRequest404('date');

    $db = DB::getConnection();

    return DB::postBatteryStatus(
        $db,
        $batteryId,
        $fartoyId,
        $flightTime,
        $capacity,
        $date
    );

}

if (!empty($_POST)) {
    $insertedId = postBatteryStatusForm();

    if (!$insertedId) {
        serverError500();
        echoline('Could not insert fartoy into database (!$insertedId)');
    } else {
        echoline("Inserted batterystatus with id: " . $insertedId);
    }
}


$db = DB::getConnection();

$batteryArray = DB::getAllBattery($db);
$fartoyArray  = DB::getAllFartoy($db);

$twig = requireTwig();
echo $twig->render('oppgave9.html');
