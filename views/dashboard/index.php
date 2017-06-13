<?php
session_start();
if(!isset($_SESSION['userSession']))
{
    header("Location: ".URL."index");
}?>

    <!DOCTYPE html>
    <html>
    <title>Camagru</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>views/dashboard/css/main.css"/>
    <script src="views/dashboard/js/default.js"></script>
<?php
    if(isset($this->css))
    {
        foreach ($this->css as $css) {
            echo '<link rel="stylesheet" href="'.URL.'views/'.$css.'"/>';
        }
    }
    ?>
    <?php
        if(isset($this->js))
        {
            foreach ($this->js as $js) {
                echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
            }
        }
    ?>
<body>
    <div id="header">
        <br>
        <a href="<?php echo URL; ?>index">Index</a>
        <?php if(isset($_SESSION['userSession'])) : ?>
            <a href="<?php echo URL; ?>gallery">Gallery</a>
            <a href="<?php echo URL; ?>logout">Logout</a>
        <?php else : ?>
            <a href="<?php echo URL; ?>login">Login</a>
        <?php endif; ?>
    </div>

<div id="content">
<div class="contentarea">
    <div class="camera">
        <video id="video">Video stream not available.</video>
        <button id="startbutton">Take photo</button>
    </div>
    <canvas id="canvas">
    </canvas>
    <div class="output">
        <img id="photo" alt="The screen capture will appear in this box.">
        <form action="saveimage">
            <button id="savebutton">Save photo</button>
        </form>
    </div>
    <ul>
        <li>
            <img src="<?php echo URL ?>views/dashboard/images/border1.png" id="border1" onclick="b1(this)">
        </li>
        <li>
            <img src="<?php echo URL ?>views/dashboard/images/border2.png" id="border2" onclick="b1(this)">
        </li>
    </ul>
    <?php

    require_once 'libs/Database.php';

    $database = new Database();
    $db = $database->dbConnection();

    $stmt = $db->prepare("select * from camagru.images where user_id=:id");
    $stmt->bindParam(":id", $_SESSION['userSession']);
    $stmt->execute();
    echo "<ul>";
    while ($userRow=$stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li><img src='".$userRow["path"]."'></li>";
    }
    echo "</ul>";

    ?>
<!--    <form method="post" action="#">-->
<!--        <input type="file">-->
<!--        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Drop image</button>-->
<!--    </form>-->
</div>
<?php require 'views/footer.php'; ?>