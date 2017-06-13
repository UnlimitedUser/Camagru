<?php
class Error_page extends Controller{
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $this->view->msg = 'This page doesnt exists';
        $this->view->render('error/index');
    }
}
?>