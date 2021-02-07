<?php
class Wish {
    private $counter_5_star = 0;
    private $counter_4_star = 0;
    private $garantee_5_star = 90;
    private $garantee_4_star = 10;

    //0.6  * 1000
    private $chance_5_star = 600;
    //5.5 * 1000
    private $chance_4_star = 5100;
    private $chance_5_star_on_4_star_pity = 600;

    public function wish():array {
        $wish_result = [
            'rarity' => 3,
            '5_star_counter' => 1
        ];
        //100% * 1000
        $rand = mt_rand(0, 100000);
        $this->counter_5_star++;
        $this->counter_4_star++;
        if($this->counter_5_star > 89) {
            $wish_result['rarity'] = 5;
            $wish_result['5_star_counter'] = $this->counter_5_star;
            $this->counter_5_star = 0;
        } elseif($this->counter_4_star > 9) {
            if($rand <= $this->chance_5_star_on_4_star_pity) {
                $wish_result['rarity'] = 5;
                $wish_result['5_star_counter'] = $this->counter_5_star;
                $this->counter_5_star = 0;
                $this->counter_4_star = 0;
            } else {
                $wish_result['rarity'] = 4;
                $wish_result['5_star_counter'] = $this->counter_5_star;
                $this->counter_4_star = 0;
            }
        } else {
            if($rand <= $this->chance_5_star) {
                $wish_result['rarity'] = 5;
                $wish_result['5_star_counter'] = $this->counter_5_star;
                $this->counter_5_star = 0;
            } elseif($rand <= $this->chance_4_star) {
                $wish_result['rarity'] = 4;
                $wish_result['5_star_counter'] = $this->counter_5_star;
                $this->counter_4_star = 0;
            }
        }
        return $wish_result;
    }
}