<?php

  class AirVehicle {
    private $name;
    private $maker;
    private $max_speed_MPH;

    public function setName($value){
      $this->name = $value;
    }
    
    public function getName(){
      return $this->name;      
    }

    public function setMaker($value){
      $this->maker = $value;
    }

    public function getMaker(){
      return $this->maker;
    }

    public function set_max_speed_MPH($value){
      $this->max_speed_MPH = $value;
    }

    public function get_max_speed_MPH(){
      return $this->max_speed_MPH;
    }

    public function getInfo(){
      return "The ".$this->getName()." is made by ".$this->getMaker()." and can go as fast as ".$this->get_max_speed_MPH()." MPH <br>";
    }

    public function getMaxSpeedKPH() {
      return $this->get_max_speed_MPH() * 1.609;
    }
  }

  class Airplane extends AirVehicle {
    private $wings = 2;

    public function setWings($value){
      $this->wings = $value;
    }

    public function getWings(){
      return $this->wings;
    }

    public function getPlaneInfo(){
      return "The ".$this->getName()." is made by ".$this->getMaker().", has ".$this->wings." wings and can go as fast as ".$this->get_max_speed_MPH()." MPH <br>";
    }
  }

  class Helicopter extends AirVehicle {
    private $blade_length;

    public function set_blade_length($value){
      $this->blade_length = $value;
    }

    public function get_blade_length(){
      return $this->blade_length;
    }

    public function getHelicopterInfo(){
      return "The ".$this->getName()." is made by ".$this->getMaker().", has a blade length of ".$this->blade_length." feet and can go as fast as ".$this->get_max_speed_MPH()." MPH <br>";
    }
  }

  $plane1 = new Airplane;
  $plane1->setName("X-15");
  $plane1->setMaker("North American Aviation");
  $plane1->set_max_speed_MPH(4520);

  echo $plane1->getInfo();
  echo $plane1->getPlaneInfo();
  echo "Max Speed in KPH: ".$plane1->getMaxSpeedKPH()."<br><br>";

  $plane2 = new Airplane;
  $plane2->setName("SR-71 Blackbird");
  $plane2->setMaker("Lockheed");
  $plane2->set_max_speed_MPH(2500);

  echo $plane2->getInfo();
  echo $plane2->getPlaneInfo();
  echo "Max Speed in KPH: ".$plane2->getMaxSpeedKPH()."<br><br>";
  echo "The ".get_class($plane1)." object is a subclass of the ".get_parent_class($plane1)." object.<br><br>";

  $helicopter1 = new Helicopter;
  $helicopter1->setName("CH-47F Chinook");
  $helicopter1->setMaker("Boeing Defense, Space & Security");
  $helicopter1->set_max_speed_MPH(175);
  $helicopter1->set_blade_length(25);

  echo $helicopter1->getInfo();
  echo $helicopter1->getHelicopterInfo();
  echo "Max Speed in KPH: ".$helicopter1->getMaxSpeedKPH()."<br><br>";
  echo "The ".get_class($helicopter1)." object is a subclass of the ".get_parent_class($helicopter1)." object.<br><br>";
?>