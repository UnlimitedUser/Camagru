<?php

class Login_Model extends Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function authentication()
    {
        
        $sth = $this->db->prepare("SELECT * FROM users WHERE 
        email= :email AND password = MD5(:password)");
        $sth->execute(array(
            ':email' => $_POST['email'],
            ':password' => $_POST['password']
        ));
    //    $data = $sth->fetchAll();
        $count = $sth->rowCount();
        if ($count > 0) {
            Session::init();
            Session::set('loggedIn', true);
            header('location: ../dashboard');
        } else {
            header('location: ../login');
        }
    }
}