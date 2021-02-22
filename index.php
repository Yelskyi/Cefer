<?php
require_once "library/Autoloader.php";
spl_autoload_register('Autoloader::autoloader');
$bootstrap = new Bootstrap();
$bootstrap->app();