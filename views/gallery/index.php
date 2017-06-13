<?php

require_once 'libs/Database.php';

$database = new Database();
$db = $database->dbConnection();

$stmt = $db->prepare("select * from camagru.images");
$stmt->execute();
echo "<ul>";
while ($userRow=$stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<li><div class='imageuser'><div><img src='".$userRow["path"]."'></div>
    <p id='"."p".$userRow['id']."'>".$userRow['likes']."</p><button id='".$userRow['id']."' class='likebutton' onclick='flike(this)'>Like</button>
    <ul id='".'ul'.$userRow['id']."'>";
    $stm = $db->prepare("select * from camagru.comments WHERE image_id=:iid");
    $stm->bindParam(":iid", $userRow['id']);
    $stm->execute();
    while ($userRow1=$stm->fetch(PDO::FETCH_ASSOC)) {
        echo "<li><p>".$userRow1['message']."</p></li>";
    }
    echo "
    </ul>
    <textarea id='".$userRow['id']."c".$userRow['user_id']."' onkeyup='comment(this)'></textarea></div></li>";
}
echo "</ul>";

?>