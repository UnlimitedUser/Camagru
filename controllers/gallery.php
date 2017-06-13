<?php
class Gallery extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->css = array('gallery/css/main.css');
        $this->view->js = array('gallery/js/gallery.js');
    }

    function index()
    {
        $this->view->render("gallery/index");
    }
}
?>