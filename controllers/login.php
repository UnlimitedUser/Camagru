<?php
class Login extends Controller {
    function __construct() {
        parent::__construct();
    }
    function index() {
        //$this->view->render("login/index");
        require 'views/login/index.php';
    }
}
?>