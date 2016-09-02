<?php

interface Locatable {
    /**
     * The location of the locatable object
     *
     * @return \Gravity\Space\Location
     */
    public function getLocation();
}
