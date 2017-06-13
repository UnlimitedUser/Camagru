<?php
class Resetpass extends Controller {
function __construct() {
parent::__construct();
}
function index() {
    require 'views/resetpass/index.php';
}
}
?>