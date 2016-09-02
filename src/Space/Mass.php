<?php
namespace Gravity\Space;

class Mass implements Locatable {
    private $_location;
    private $_mass;
    private $_velocity;

    public function __construct($mass, Location $location, Velocity $velocity) {
        $this->_location = $location;
        $this->_mass = $mass;
        $this->_velocity = $velocity;
    }

    public function getLocation() {
        return $this->_location;
    }

    public function getVelocity() {
        return $this->_velocity;
    }
}
