<?php
class Verify extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->render("verify/index");
    }
}
?>