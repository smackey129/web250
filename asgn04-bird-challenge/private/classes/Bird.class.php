<?php 

class Bird {
  public $common_name;
  public $habitat;
  public $food;
  public $nest_palcement;
  public $behavior;
  public $conservation_id;
  public $backyard_tips;

  public function __construct($args=[])
  {
    $this->common_name = $args['common_name'];  
    $this->habitat = $args['habitat'];
    $this->food = $args['food'];
    $this->nest_palcement = $args['nest_palcement'];
    $this->behavior = $args['behavior'];
    $this->conservation_id = $args['conservation_id'];
    $this->backyard_tips = $args['backyard_tips'];  
  }
}
?>