<?php
class Analyzer {
    private $limit;
    private $simulation_resultsRG = [];
    private $crit_hit_chance = [];
    private $simulation_resultsSP = [];

    public function __construct($limit) {
        $this->limit = $limit;
    }

    public function simulateRoyalGrimoire($default_crit = 5, $default_additional_crit = 8, $target_additional_crit = 16) {
        while($default_crit <= 20) {
            $this->simulation_resultsRG[$default_crit] = [];
            $additional_crit = $default_additional_crit;
            while($additional_crit <= $target_additional_crit) {
                $crit_counter = 0;
                $character = new Character($default_crit,(189 + 497), 75, 350, 2.3, $additional_crit);
                for($i = 0; $i<$this->limit; $i++) {
                    if($character->hit()) {
                        $crit_counter++;
                    }
                }
                //$character->getCritHitCounter();
                $this->simulation_resultsRG[$default_crit][$additional_crit] = [
                    "average_chance" => $crit_counter/$this->limit*100,
                    "additional_chance" => $crit_counter/$this->limit*100 - $default_crit
                ];
                $additional_crit += 2;
            }
            $default_crit += 5;
        }
    }

    public function simulateSolarPerl() {
        $character = new Character(5,(189 + 449), 50, 350, 2.3);
        $this->simulation_results = [
            5 => $character->calculateDPS(0.30),
            10 => $character->calculateDPS(0.35),
            15 => $character->calculateDPS(0.40),
            20 => $character->calculateDPS(0.45)
        ];
    }

    public function getSimulation() {
        return $this->simulation_resultsRG;
    }
}