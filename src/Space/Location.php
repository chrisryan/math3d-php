<?php
namespace Gravity\Space;

class Location {
    private $x;
    private $y;

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function distance(Location $loc){
        return sqrt(pow($loc->x - $this->x, 2) + pow($loc->y - $this->y, 2));
    }
}
