<?php
session_start();
require_once 'libs/Database.php';

$database = new Database();
$db = $database->dbConnection();

$stmt = $db->prepare("select count(*) from camagru.images;");
$stmt->execute();
$number_of_rows = $stmt->fetchColumn();
copy("views/dashboard/result.png", "public/userimages/image".$number_of_rows.".png");
try
{
    $stmt = $db->prepare("INSERT INTO camagru.images(user_id,path,likes) 
                                                VALUES(:user_id, :path, :likes)");
    $stmt->bindparam(":user_id",$_SESSION['userSession']);
    $dsa = "public/userimages/image".$number_of_rows.".png";
    $stmt->bindparam(":path", $dsa);$a = 0;
    $stmt->bindparam(":likes", $a);
    $stmt->execute();
}
catch(PDOException $ex)
{
    echo $ex->getMessage();
}
header("Location: ".URL."dashboard");