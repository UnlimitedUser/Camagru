<?php
require '/Applications/MAMP/htdocs/Camagru/config/database.php';

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

$database = new Database();
$db = $database->dbConnection();

$stmt = $db->prepare("select * from camagru.images where id=:uid");
$stmt->bindParam(":uid", $_POST['q']);
$stmt->execute();
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
$userRow['likes']++;
$stmt = $db->prepare("update camagru.images set likes=:lik where id=:u");
$stmt->bindParam(":u", $_POST['q']);
$stmt->bindParam(":lik", $userRow['likes']);
$stmt->execute();
?>