<?php


/**
 * Singleton class managing the connection with the database.
 * This class also implements functions for solving exercies 1 - 4.
 */
class DB {

    private static $db=null;
    private $dsn = 'mysql:dbname=imt2291_eksamen2018;host=127.0.0.1;charset=utf8mb4';
    private $user = 'root';
    private $password = '';
    private $dbh = null;

    /**
     * Constructor
     * @return null - if connection not established (to be implemented)
     */
    private function __construct() {
        try {      
        $this->dbh = new PDO($this->dsn, $this->user, $this->password);

        // @note
        // Debugging mode, giving error messages when SQL queries fail.
        //   Turn off during produciton. 
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * Gets existing connection to the database.
     * Creates a new connection if one does not exist yet.
     * @return $dbh - database handle
     * @return null - if connection not established (to be implemented)
     */
    public static function getConnection() {
        if (DB::$db==null) {
            DB::$db = new self();
        }
        return DB::$db->dbh;
    }


    /**
     * Prepares an SQL statement and executes it safely
     * @param $db - pdo database handle
     * @param  $sql  - sql string
     * @param  $param - array of parameters matching the sql string
     * @return $stmt - executed statement
     */
    private static function prepareThenExecute($db, $sql, $param) {
    
        try {        
        
        $stmt = $db->prepare($sql);
        $stmt->execute($param);

        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $stmt;
    }


    /**
     * Post new battery entry in the database
     * @param $db - pdo database handle
     * @param id - unique id of battery, primary key
     * @param cellCount - number of cells in battery
     * @param capacity - battery capacity in mAh  50-20000
     * @param Crating(maxdischarge) - 1 - 200
     * @param purchaseDate - when the battery was purchased
     * @return lastinsertID | null if error
     */
    public static function postBattery($db,
                                       $id,
                                       $cellCount,
                                       $capacity,
                                       $maxDischarge,
                                       $purchaseDate) {

        $stmt = DB::prepareThenExecute(
            $db,
            "SELECT * FROM batteries WHERE id=?", 
            array($id)
        );


        if ($stmt->rowCount() > 0) {
            echo "error 1 - a battery with that id already exist";
            return null;
        }

        $stmt = DB::prepareThenExecute(
            $db,
            "INSERT INTO batteries (id, cells, capacity, maxDischarge, purchaseDate) ".
            "VALUES (?, ?, ?, ?, ?)",
            array(
                $id,
                $cellCount,
                $capacity,
                $maxDischarge,
                $purchaseDate
            )
        );

        if ($stmt->rowCount() !== 1) {
            echo " error 2 - row was not inserted";
            return null;
        }
        return $id;
    }

}
