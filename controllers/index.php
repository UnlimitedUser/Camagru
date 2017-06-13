<?php
class Index extends Controller{
    function __construct() {
        parent::__construct();
        $this->view->css = array('index/css/main.css');
    }
    
    function index() {
        $this->view->render('index/index');
    }
}
?>