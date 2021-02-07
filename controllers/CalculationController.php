<?php
class CalculationController extends Controller {

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function simulate() {
        $analyzer = new Analyzer(10000);
        $analyzer->simulateRoyalGrimoire();
        $this->view->simulation_resultsRG = $analyzer->getSimulation();
    }

    public function simulateIncresedHitsChance() {
        $analyzer = new Analyzer(10000);
        $analyzer->simulateRoyalGrimoire(5, 8, 9);
    }

    public function simulateWishes() {
        $wishes = new Wish();
        $limit = 1000000;
        $simulation_results = [];
        for($i=0; $i<$limit; $i++) {
            $wish_result = $wishes->wish();
            if($wish_result['rarity'] === 5) {
                if(!isset($simulation_results[$wish_result['5_star_counter']])) {
                    $simulation_results[$wish_result['5_star_counter']] = 1;
                } else {
                    $simulation_results[$wish_result['5_star_counter']]++;
                }
            }
        }

        ksort($simulation_results);
        $this->view->simulation_results = $simulation_results;
        $this->setView("views/wishes-results.phtml");
    }

    public function compareWeapons() {
        $default_crit = 14.4;
        $base_attack = 188;
        $additional_attack_percent = 49.6;
        $additional_flat_attack = 327;
        $crit_dmg = 2.259;

        $weapon_attack = 449;
        $weapon_crit = 25.1;
        $weapon_attack_percent = 10;

        $character = new Character(
            $default_crit + $weapon_crit,
            $base_attack + $weapon_attack,
            $additional_attack_percent + $weapon_attack_percent,
            $additional_flat_attack,
            $crit_dmg);
        var_dump($character->calculateDPS());

        $analyzer = new Analyzer(10000);
        $analyzer->simulateRoyalGrimoire($default_crit, 8, 9);
        $crit_chance_data = $analyzer->getSimulation();

        $weapon_crit = $crit_chance_data[$default_crit][8]["additional_chance"];
        $weapon_attack = 497;
        $weapon_attack_percent = 25;

        $character = new Character(
            $default_crit + $weapon_crit,
            $base_attack + $weapon_attack,
            $additional_attack_percent + $weapon_attack_percent,
            $additional_flat_attack,
            $crit_dmg);

        var_dump($character->calculateDPS());
    }
}