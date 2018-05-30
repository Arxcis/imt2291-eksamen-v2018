<?php
session_start();


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-OriginalMimetype, X-OriginalFilename, X-OriginalFilesize');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');
header('Content-Type: application/json');


require_once __DIR__ . "/../DB.php";
require_once __DIR__ . "/../helper.php";



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

$insertedId = postBatteryStatusForm();

if (!$insertedId) {
    echo json_encode(array("msg" => 'Could not insert fartoy into database (!$insertedId)'));
} else {
    echo json_encode(array('id' => $insertedId));
}