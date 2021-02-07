<?php
class Controller {
    public $view;
    private $controller;
    private $action;

    public function __construct($controller, $action) {
        $this->controller = $controller;
        $this->action = $action;

        $view_path = "views/".$action.".phtml";
        $this->view = new View($view_path);
    }

    public function setView($view_name) {
        if(file_exists($view_name)) {
            $this->view->changeView($view_name);
        }
    }

    public function postDispatch() {
        $this->view->displayView();
    }
}