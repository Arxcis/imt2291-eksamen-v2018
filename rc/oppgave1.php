<?php

require_once "DB.php";

function badRequest404($key) {

    echo "ERROR - Bad Request 404. Missing: " . $key;
    die();
}

function serverError500() {

    echo "ERROR - Server Error";
    die();   
}

function postBatteryForm() {

    $id           = $_POST['id']            ?? badRequest404('id');
    $cellCount    = $_POST['cell-count']    ?? badRequest404('cell-count');
    $capacity     = $_POST['capacity']      ?? badRequest404('capacity');
    $maxDischarge = $_POST['max-discharge'] ?? badRequest404('max-discharge');
    $date         = $_POST['date']          ?? badRequest404('date');

    $db = DB::getConnection();

    return DB::postBattery(
        $db,
        $id,
        $cellCount,
        $capacity,
        $maxDischarge,
        $date
    );

//   var_dump($id, $cellCount, $capacity, $maxDischarge, $date);
}

if (!empty($_POST)) {
    $insertedId = postBatteryForm();

    if (!$insertedId) {
        serverError500();
    }

    echo "inserted battery with id: " . $insertedId;
}

?>  

<!DOCTYPE html>
<html>
<head>


<title>Eksamen - Oppgave 1</title>
<style>
    input {
        width: 100%;
        display: block;
    }
</style>



</head>
<body>


<header>
    <h1>Registrer nytt batteri</h1>
</header>


<main>

    <!-- TODO use proper paths -->
    <form action="oppgave1.php" 
          method="post"
          id="form-battery"
          name="battery"
          autocomplete>

    <label for="input-battery-id">ID:</label>
    <input id="input-battery-id" 
           type="number" 
           name="id"
           min=1
           max=1000
           placeholder="1-1000"
           required/>


    <label for="input-battery-cell-count">Cell count:</label>
    <input id="input-battery-cell-count" 
           type="number" 
           name="cell-count"
           min=1
           max=24
           placeholder="1-24"
           required/>



    <label for="input-battery-capacity">Capacity:</label>
    <input id="input-battery-capacity" 
           type="number" 
           name="capacity"
           min=50
           max=20000
           placeholder="50-20000"
           required/>



    <label for="input-battery-max-discharge">Max Discharge(C-rating):</label>
    <input id="input-battery-max-discharge" 
           type="number" 
           name="max-discharge"
           min=1
           max=200
           placeholder="1-200"
           required/>


    <label for="input-battery-date">Date:</label>
    <input id="input-battery-date" 
           type="date" 
           name="date"
           value="2018-05-29"
           min="1970-01-01" 
           max="2099-01-01"
           placeholder="2018-05-29"
           required/>


    <input id="btn-submit-battery-info"
           type="submit"
           value="Lagre informasjon"/> 

    </form>

</main>


</body>
</html>
