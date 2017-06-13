<?php
class Saveimage extends Controller {
    function __construct() {
        parent::__construct();
    }
    function index() {
        require 'views/dashboard/saveimage.php';
    }
}