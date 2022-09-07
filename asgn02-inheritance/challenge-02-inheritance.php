<?php

  class AirVehicle {
    var $name;
    var $maker;
    var $max_speed_MPH;

    function getInfo(){
      return "The ".$this->name." is made by ".$this->maker." and can go as fast as ".$this->max_speed_MPH." MPH <br>";
    }

    function getMaxSpeedKPH() {
      return $this->max_speed_MPH * 1.609;
    }
  }

  class Airplane extends AirVehicle {
    var $wings;

    function getInfo(){
      return "The ".$this->name." is made by ".$this->maker.", has ".$this->wings." wings and can go as fast as ".$this->max_speed_MPH." MPH <br>";
    }
  }

  class Helicopter extends AirVehicle {
    var $blade_length;

    function getInfo(){
      return "The ".$this->name." is made by ".$this->maker.", has a blade length of ".$this->blade_length." feet and can go as fast as ".$this->max_speed_MPH." MPH <br>";
    }
  }

  $plane1 = new Airplane;
  $plane1->name = "X-15";
  $plane1->maker = "North American Aviation";
  $plane1->max_speed_MPH = 4520;
  $plane1->wings = 2;

  echo $plane1->getInfo();
  echo "Max Speed in KPH: ".$plane1->getMaxSpeedKPH()."<br><br>";

  $plane2 = new Airplane;
  $plane2->name = "SR-71 Blackbird";
  $plane2->maker = "Lockheed";
  $plane2->max_speed_MPH = 2500;
  $plane2->wings = 2;

  echo $plane2->getInfo();
  echo "Max Speed in KPH: ".$plane2->getMaxSpeedKPH()."<br><br>";
  echo "The ".get_class($plane1)." object is a subclass of the ".get_parent_class($plane1)." object.<br><br>";

  $helicopter1 = new Helicopter;
  $helicopter1->name = "CH-47F Chinook";
  $helicopter1->maker = "Boeing Defense, Space & Security";
  $helicopter1->max_speed_MPH = 175;
  $helicopter1->blade_length = 25;

  echo $helicopter1->getInfo();
  echo "Max Speed in KPH: ".$helicopter1->getMaxSpeedKPH()."<br><br>";
  echo "The ".get_class($helicopter1)." object is a subclass of the ".get_parent_class($helicopter1)." object.<br><br>";
?>