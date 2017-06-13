<?php
class View extends Controller{
    function __construct() {
        // echo 'This is the view <br>';
    }
    public function render($name)
    {
        require 'views/header.php';
        require 'views/' . $name . '.php';
        require 'views/footer.php';
    }
}
?>