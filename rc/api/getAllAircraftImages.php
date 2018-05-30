<?php

session_start();

require_once __DIR__ . "/../DB.php";

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-OriginalMimetype, X-OriginalFilename, X-OriginalFilesize');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');
header('Content-Type: application/json');


if (empty($_GET['id']))
    die();


$aircraftId = $_GET['id'];


$db = DB::getConnection();
$aircraftImages = DB::getAircraftImages($db, $aircraftId);


$encodedAircraftImages = encodeThumbnailsToBase64($aircraftImages);
echo json_encode($encodedAircraftImages);
