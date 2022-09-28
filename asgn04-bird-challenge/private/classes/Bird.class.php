<?php 

class Bird {
  public $common_name;
  public $habitat;
  public $food;
  public $nest_placement;
  public $behavior;
  public $conservation_id;
  public $backyard_tips;
  public const CONSERVATION_LEVELS = [
    1 => 'Low',
    2 => 'Moderate',
    3 => 'High',
    4 => 'Extreme'
  ];

  public function __construct($args=[])
  {
    $this->common_name = $args['common_name'];  
    $this->habitat = $args['habitat'];
    $this->food = $args['food'];
    $this->nest_placement = $args['nest_placement'];
    $this->behavior = $args['behavior'];
    $this->conservation_id = $args['conservation_id'];
    $this->backyard_tips = $args['backyard_tips'];  
  }

  public function conservation_level(){
    if($this->conservation_id > 0 AND $this->conservation_id) {
      return self::CONSERVATION_LEVELS[$this->conservation_id];
    } else {
      return "Unknown";
    }
  }
}
?>