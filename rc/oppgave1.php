<!DOCTYPE html>
<html>
<head>
    <title>Eksamen - Oppgave 1</title>
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
          name="battery">

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


    <!-- TODO Set default value of date to date.now() using javascript -->
    <label for="input-battery-date">Date:</label>
    <input id="input-battery-date" 
           type="date" 
           name="date"
           placeholder="dd.mm.yyyy"
           required/>


    <input id="btn-submit-battery-info"
           type="submit"
           value="Lagre informasjon"/> 

    </form>

</main>


</body>
</html>
