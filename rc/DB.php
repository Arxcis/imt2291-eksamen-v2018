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
     */
    private function __construct() {
        $this->dbh = new PDO($this->dsn, $this->user, $this->password);

        // @note
        // Debugging mode, giving error messages when SQL queries fail.
        //   Turn off during produciton. 
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Gets existing connection to the database.
     * Creates a new connection if one does not exist yet.
     * @return $dbh - database handle
     */
    public static function getDBConnection() {
        if (DB::$db==null) {
            DB::$db = new self();
        }
        return DB::$db->dbh;
    }

    
}
