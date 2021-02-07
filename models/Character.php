<?php
class Character {
    private $crit_hit_data = [];
    private $non_crit_hit_data = [];
    private $total_hit_data = [];

    private $crit_rate;
    private $default_crit;
    private $additional_crit_rate;
    private $non_crit_counter = 0;

    private $base_attack;
    private $additional_attack_percent;
    private $additional_flat_attack;
    private $crit_dmg;

    public function __construct($default_crit, $base_attack,$additional_attack_percent,
                                $additional_flat_attack, $crit_dmg, $additional_crit_rate = 0) {
        $this->default_crit = $default_crit;
        $this->crit_rate = $default_crit;
        $this->additional_crit_rate = $additional_crit_rate;
        $this->base_attack = $base_attack;
        $this->additional_attack_percent = $additional_attack_percent;
        $this->additional_flat_attack = $additional_flat_attack;
        $this->crit_dmg = $crit_dmg;
    }

    public function getCritHitCounter() {
        ksort($this->crit_hit_data);
        ksort($this->total_hit_data);
        var_dump([
            $this->crit_hit_data,
            $this->total_hit_data
        ]);die;
        return $this->crit_hit_data;
    }

    public function hit() {
        $random = mt_rand(0,100);
        $hit_result = true;
        if(isset($this->total_hit_data[$this->non_crit_counter + 1])) {
            $this->total_hit_data[$this->non_crit_counter + 1] = $this->total_hit_data[$this->non_crit_counter + 1] + 1;
        } else {
            $this->total_hit_data[$this->non_crit_counter + 1] = 1;
        }
        if($random <= $this->crit_rate) {
            if(isset($this->crit_hit_data[$this->non_crit_counter + 1])) {
                $this->crit_hit_data[$this->non_crit_counter + 1] = $this->crit_hit_data[$this->non_crit_counter + 1] + 1;
            } else {
                $this->crit_hit_data[$this->non_crit_counter + 1] = 1;
            }
            $this->non_crit_counter = 0;
            $this->crit_rate = $this->default_crit;
        } else {
            $this->non_crit_counter++;
            if($this->non_crit_counter <= 5) {
                $this->crit_rate += $this->additional_crit_rate;
            }
            $hit_result = false;
        }
        return $hit_result;
    }

    public function calculateDPS($crit_rate = null) {
        $this->crit_rate = $crit_rate ?? $this->crit_rate/100;
        $attack = $this->base_attack + ($this->base_attack * ($this->additional_attack_percent/100)) + $this->additional_flat_attack;
        $crit_attack_part = $this->crit_rate * $attack * $this->crit_dmg;
        $normal_attack_part = (1 - $this->crit_rate) * $attack;
        return $crit_attack_part + $normal_attack_part;
    }
}