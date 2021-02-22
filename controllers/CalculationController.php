<?php
class CalculationController extends Controller {

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function act() {
        return new View('act');
    }

    public function calculate() {
        return new View('calculate.phtml', [
            'param' => 'Hello World'
        ]);
    }
}