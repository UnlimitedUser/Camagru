<?php
class Bootstrap {
    function __construct() {
        $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : null;
        if (empty($url[0])) {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return true;
        }
        if ($url[0] == "setup") {
            require 'config/setup.php';
            header("Location: " . URL);
        }
            $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            require 'controllers/error.php';
            $controller = new Error_page();
            $controller->index();
            return false;
        }
        
        $controller = new $url[0];
        $controller->loadModel($url[0]);
        
        if (isset($url[2])) {
            $controller->$url[1]($url[2]);
        }
        else if (isset($url[1])) {
            $controller->$url[1]();
        }
        
        $controller->index();
    }
}
?>