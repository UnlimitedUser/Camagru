<?php
session_start();
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
$stmt = $db->prepare("insert into camagru.comments(user_id, commenter_id, image_id, message) VALUES (:uid, :cid, :iid, :m)");
$stmt->bindParam(":uid", $_POST['q']);
$stmt->bindParam(":cid", $_SESSION['userSession']);
$stmt->bindParam(":iid", $_POST['i']);
$stmt->bindParam(":m", $_POST['d']);
$stmt->execute();

$stm = $db->prepare("select * from camagru.users where id=:uid");
$stm->bindParam(":uid", $_POST['q']);
$stm->execute();

$st = $db->prepare("select * from camagru.users where id=:uid");
$st->bindParam(":uid", $_SESSION['userSession']);
$st->execute();

$row = $stm->fetch(PDO::FETCH_ASSOC);
$ro = $st->fetch(PDO::FETCH_ASSOC);
mail($row['email'], "You have a comment", "User ".$ro['username']." commented on your photo: ".$_POST['d']);