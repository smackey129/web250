<?php

class Bicycle  
{
  var $brand;
  var $model;
  var $year;
  var $description;
  var $weight_kg = 0.0;

  function name() {
    return $this->brand .", ". $this->model .", ". $this->year;
  }

  function weight_lbs() {
    return 2.2046226218 * $this->weight_kg;
  }

  function set_weight_lbs($weight_lbs)
  {
    $this->weight_kg = $weight_lbs / 2.2046226218;
  }
}

$bike1 = new Bicycle;
$bike1->brand = 'Trek';
$bike1->model = 'Emonda';
$bike1->year = '2017';
$bike1->weight_kg = 1.0;

$bike2 = new Bicycle;
$bike2->brand = 'Cannondale';
$bike2->model = 'Synapse';
$bike2->year = '2016';
$bike2->weight_kg = 8.0;

echo $bike1->name() . "<br>";
echo $bike2->name() . "<br>";

echo $bike1->weight_kg . "<br>";
echo $bike1->weight_lbs() . "<br>";

$bike1->set_weight_lbs(2);
echo $bike1->weight_kg . "<br>";
echo $bike1->weight_lbs() . "<br>";