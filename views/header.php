<?php Session::init(); ?>
<!DOCTYPE html>
<html>
    <title>Camagru</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css"/>
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