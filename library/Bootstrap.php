<?php
require_once 'library/Autoloader.php';
class Bootstrap {
    public function app() {
        spl_autoload_register('Autoloader::autoloader');
        $url_data = explode("/",  $_SERVER["REQUEST_URI"]);
        $controller = !empty($url_data[1]) ? $url_data[1] : "index";
        $action = !empty($url_data[2]) ? $url_data[2] : "index";
        $controller = ucfirst(strtolower($controller));
        $action = strtolower($action);
        require_once "controllers/Controller.php";
        require_once "controllers/".$controller."Controller.php";
        $helper = new Helper();
        $action_method = $helper->toCamelCase($action);
        $controller_name = $controller."Controller";
        $controller_obj = new $controller_name($controller, $action);
        $response = $controller_obj->$action_method();
        if($response->isView()) {
            $response->displayView();
        } elseif($helper->isJson($response)) {
            echo $response;
        }

    }
}