<?php
require "config/database.php";
class Database
{
    public $conn;

    public function dbConnection()
    {

        $this->conn = null;
        try
        {
            $this->conn = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>