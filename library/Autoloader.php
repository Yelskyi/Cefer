<?php
class Autoloader {
    public function __construct()
    {
    }

    public static function autoloader($class_name) {
        $classesDir = array (
            'models/',
            'library/'
        );
        foreach ($classesDir as $directory) {
            if (file_exists($directory . $class_name . '.php')) {
                require_once ($directory . $class_name . '.php');
                return;
            }
        }
    }
}