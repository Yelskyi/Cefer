<?php
class View {
    private $is_view = true;
    private $view_path;

    public function __construct($view_path, $view_params) {
        $this->view_path = $view_path;
        foreach ($view_params as $param_name => $param) {
            $this->$param_name = $param;
        }
    }

    public function isView():bool {
        return $this->is_view;
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
        if(!preg_match('/', $this->view_path)) {
            $this->view_path = 'views/'.$this->view_path;
        }
        if(file_exists($this->view_path)) {
             require_once $this->view_path;
        }
    }
}