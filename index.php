<?php
foreach (glob("models/*.php") as $filename) {
    include $filename;
}
foreach (glob("library/*.php") as $filename) {
    include $filename;
}

$url_data = explode("/",  $_GET["_url"]);
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
$controller_obj->$action_method();
if(method_exists($controller_obj, "postDispatch")) {
    $controller_obj->postDispatch();
}

