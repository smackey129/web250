<?php

class Bicycle extends DatabaseObject {

  static protected $table_name = 'bicycles';
  static protected $db_columns = ['id', 'brand', 'model', 'year', 'category', 'color', 'gender', 'price', 'weight_kg', 'condition_id', 'description'];

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->brand)) {
      $this->errors[] = "Brand cannot be blank.";
    }
    if(is_blank($this->model)) {
      $this->errors[] = "Model cannot be blank.";
    }
    return $this->errors;
  }

  public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'City', 'Cruiser', 'BMX'];
  public const GENDERS = ['Men', 'Women', 'Unisex'];
  public const CONDITION_OPTIONS = [1 => 'Beat up', 2 => 'Decent', 3 => 'Good', 4 => 'Great', 5 => 'Like New'];

  public $id;
  public $brand;
  public $model;
  public $year;
  public $category;
  public $color;
  public $description;
  public $gender;
  public $price;
  public $condition_id;
  public $weight_kg;

  public function __construct($args=[])
  {
    $this->brand = $args['brand'] ?? '';
    $this->model = $args['model'] ?? '';
    $this->year = $args['year'] ?? '';
    $this->category = $args['category'] ?? '';
    $this->color = $args['color']  ?? '';
    $this->description = $args['description']  ?? '';
    $this->gender = $args['gender'] ?? ''; 
    $this->price = $args['price']  ?? 0.0;
    $this->weight_kg = $args['weight_kg']  ?? 0.0;
    $this->condition_id = $args['condition_id']  ?? 3;
  }

  public function name() {
    return "{$this->brand} {$this->model} {$this->year}";
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
      return self::CONDITION_OPTIONS[$this->condition_id];
    else
      return 'Invalid condition_id';
  }
}

?>