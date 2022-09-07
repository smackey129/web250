<?php

class Bicycle {

  public $brand;
  public $model;
  public $year;
  public $description = 'Used bicycle';
  private $weight_kg = 0.0;
  protected $wheels = 2;

  public function name() {
    return $this->brand . " " . $this->model . " (" . $this->year . ")";
  }

  public function weight_lbs() {
    return floatval($this->weight_kg) * 2.2046226218." lbs";
  }

  public function set_weight_lbs($value) {
    $this->weight_kg = floatval($value) / 2.2046226218;
  }

  public function wheel_details() {
    if($this->wheels == 1)
      return "It has 1 wheel.";
    else
      return "It has ".$this->wheels." wheels.";
  }

  public function set_weight_kg($value) {
    $this->weight_kg = $value;
  }

  public function weight_kg() {
    return $this->weight_kg." kg";
  }

}

class Unicycle extends Bicycle {
  protected $wheels = 1;

}

$trek = new Bicycle;
$trek->brand = 'Trek';
$trek->model = 'Emonda';
$trek->year = '2017';

$uni = new Unicycle;

echo "Bicycle: ".$trek->wheel_details()."<br>";
echo "Unicycle: ".$uni->wheel_details()."<br><br>";

$trek->set_weight_kg(1.0);
$uni->set_weight_kg(2.0);

echo "Bicycle: ".$trek->weight_kg().", ".$trek->weight_lbs()."<br>";
echo "Unicycle: ".$uni->weight_kg().", ".$trek->weight_lbs()."<br><br>";

?>
