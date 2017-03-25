<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/25/17
 * Time: 12:09 PM
 */
class DB
{
    private $databaseName = 'api_db';
    private $password = '';
    private $databaseHost = 'localhost';
    private $databaseUser = 'root';
    private $conn;

    public function connect(){
        try{

            $this->conn = new PDO(
                "mysql:host={$this->databaseHost};
                dbname={$this->databaseName}",
                $this->databaseUser,
                $this->password
            );
            echo "connected to ".$this->databaseName;
            return $this->conn;

        } catch (PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function closeConnection(){
        $this->conn = null;
        return true;
    }
}

/*
 * create instance and connect to the db
 */
$db = new DB();
$conn = $db->connect();
