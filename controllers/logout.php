<?php

class Logout extends Controller {
function __construct() {
parent::__construct();
    session_start();
    require_once 'libs/User.php';
    $user = new USER();

    if(!$user->is_logged_in())
    {
        $user->redirect('index');
    }

    if($user->is_logged_in()!="")
    {
        $user->logout();
        $user->redirect('index');
    }
}
}
?>