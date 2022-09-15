<?php

class Bird {
    var $habitat;
    var $food;
    var $nesting = "tree";
    var $conservation;
    var $song = "chirp";
    var $flying = "yes";
    public static $instance_count = 0;
    public static $egg_num = 0;

    function can_fly() {
        return ( $this->flying == "yes" ) ? "can fly" : "is stuck on the ground";
    }

    public static function create() {
      $class = get_called_class();
      static::$instance_count++;
      return new $class();
    }
}

class YellowBelliedFlyCatcher extends Bird {
    var $name = "yellow-bellied flycatcher";
    var $diet = "mostly insects.";
    var $song = "flat chilk";
    public static $egg_num = "3-4, sometimes 5";
}

class Kiwi extends Bird {
    var $name = "kiwi";
    var $diet = "omnivorous";
    var $flying = "no";
}
