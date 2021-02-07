<?php
class View {
    private $view_path;

    public function __construct($view_path) {
        $this->view_path = $view_path;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
    public function changeView($view_path) {
        $this->view_path = $view_path;
    }

    public function displayView() {
        if(file_exists($this->view_path)) {
             require_once $this->view_path;
        }
    }
}