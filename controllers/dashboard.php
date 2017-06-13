<?php
class Dashboard extends Controller {
    function __construct() {
        parent::__construct();
        $this->view->js = array('dashboard/js/default.js');
        $this->view->css = array('dashboard/css/main.css');
    }
    function index() {
        //$this->view->render("dashboard/index");
        require 'views/dashboard/index.php';
    }

}
?>