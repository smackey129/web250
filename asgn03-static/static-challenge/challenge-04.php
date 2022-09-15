<?php

class Bicycle {
  public static $instance_count = 0;
  public $brand;
  public $model;
  public $year;
  public $description = 'Used bicycle';
  public $has_training_wheels = false;
  protected $weight_kg = 0.0;
  protected static $wheels = 2;
  public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Cruiser', 'City', 'BMX'];
  public $category;

  public static function create() {
    self::$instance_count++;
    return new static;
  }

  public function name() {
    return $this->brand . " " . $this->model . " (" . $this->year . ")";
  }

  public static function wheel_details() {
    $wheel_string = static::$wheels == 1 ? "1 wheel" : static::$wheels." wheels";
    return "It has ".$wheel_string.".";
  }

  public function weight_kg() {
    return $this->weight_kg . ' kg';
  }

  public function set_weight_kg($value) {
    $this->weight_kg = floatval($value);
  }

  public function weight_lbs() {
    $weight_lbs = floatval($this->weight_kg) * 2.2046226218;
    return $weight_lbs . ' lbs';
  }

  public function set_weight_lbs($value) {
    $this->weight_kg = floatval($value) / 2.2046226218;
  }

  public function toggle_training_wheels() {
    ($this->has_training_wheels) ? $this->has_training_wheels = false : $this->has_training_wheels = true;
  }
}

class Unicycle extends Bicycle {
  // visibility must match property being overridden
  protected static $wheels = 1;
  public $has_training_wheels = false;
  public $can_have_training_wheels = false;

  public function bug_test() {
    return $this->weight_kg;
  }

  public function name() {
    $details = parent::name();
    return "Unicycle Details: $details";
  }

  public function toggle_training_wheels() {
    if(!$this->can_have_training_wheels) 
      $this->has_training_wheels = false;
    else
      parent::toggle_training_wheels();
      
  }
}

$trek = new Bicycle;
$trek->brand = 'Trek';
$trek->model = 'Emonda';
$trek->year = '2017';

echo 'Bicycle count: '.Bicycle::$instance_count.'<br>';
echo 'Unicycle count: '.Unicycle::$instance_count.'<br>';

$bike = Bicycle::create();
$uni = Unicycle::create();

echo 'Bicycle count: '.Bicycle::$instance_count.'<br>';
echo 'Unicycle count: '.Unicycle::$instance_count.'<br>';

echo "<hr>";
echo 'Categories: '.implode(', ', Bicycle::CATEGORIES).'<br>';
$trek->category = Bicycle::CATEGORIES[0];
echo 'Category: '.$trek->category.'<br>';

echo "<hr>";

echo "Bicycle: ".Bicycle::wheel_details()."<br>";
echo "Unicycle: ".Unicycle::wheel_details()."<br>";

?>