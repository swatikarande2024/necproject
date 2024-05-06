<?php  
/*** Database connection config file */

class Database {

	private $hostName = "localhost";
	private $dbName   = "NECdemo";
	private $userName = "root";
	private $password = "";
	private $dbConnection;

	public function connect() {
       $this->dbConnection = null;

       try {
			$this->dbConnection = new PDO('mysql:host='.$this->hostName. ';dbname='.$this->dbName, $this->userName, $this->password );			
			$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       } catch(PDOException $e){
          	echo "Connection error: ".$e->getMessage();
       }

       return $this->dbConnection;
	}

}