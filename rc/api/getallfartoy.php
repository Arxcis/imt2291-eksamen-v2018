<?php


require_once __DIR__ . "/../DB.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-OriginalMimetype, X-OriginalFilename, X-OriginalFilesize');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');
header('Content-Type: application/json');


$db = DB::getConnection();
$allfartoy = DB::getAllFartoy($db);

echo json_encode($allfartoy);
