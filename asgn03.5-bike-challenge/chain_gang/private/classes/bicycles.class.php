<?php

class Bicycle {

  public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Road', 'Cruiser', 'BMX'];
  public const GENDERS = ['Men', 'Women', 'Unisex'];
  public const CONDITIONS = [1 => 'Beat up', 2 => 'Decent', 3 => 'Good', 4 => 'Great', 5 => 'Like New'];

  public $brand;
  public $model;
  public $year;
  public $category;
  public $color;
  public $description;
  public $gender;
  public $price;
  public $condition_id;
  protected $weight_kg;

  public function __construct($args=[])
  {
    $this->brand = $args['brand'] ?? NULL;
    $this->model = $args['model'] ?? NULL;
    $this->year = $args['year'] ?? NULL;
    $this->category = $args['category'] ?? NULL;
    $this->color = $args['color']  ?? NULL;
    $this->description = $args['description']  ?? NULL;
    $this->gender = $args['gender'] ?? NULL; 
    $this->price = $args['price']  ?? 0.0;
    $this->weight_kg = $args['weight_kg']  ?? 0.0;
    $this->condition_id = $args['condition_id']  ?? 3;
  }

  public function weight_kg()
  {
    return number_format($this->weight_kg, 2) .' kg';
  }

  public function set_weight_kg($weight_kg)
  {
    $this->weight_kg = $weight_kg;
  }

  public function weight_lbs()
  {
    $weight_lbs =  $this->weight_kg / .454;
    return number_format($weight_lbs, 2) .' lbs';
  }

  public function set_weight_lbs($weight_lbs)
  {
    $this->weight_kg = $weight_lbs * .454;
  }

  public function condition() {
    if($this->condition_id > 0 AND $this->condition_id <= 5)
      return self::CONDITIONS[$this->condition_id];
    else
      return 'Invalid condition_id';
  }
}

?>