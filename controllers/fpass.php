<?php
class Fpass extends Controller {
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->view->render("fpass/index");
    }
}
?>