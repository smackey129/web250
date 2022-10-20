<?php 

class Bird extends DatabaseObject{

  static protected $db_columns = ['id', 'common_name', 'habitat', 'food', 'conservation_id', 'backyard_tips'];
  static protected $table_name = 'birds';


  protected function validate() {
    $this->errors = [];

    if(is_blank($this->common_name)) {
      $this->errors[] = "Common Name cannot be blank";
    }
    return $this->errors;
  }

  
  public $id;
  public $common_name;
  public $habitat;
  public $food;
  public $conservation_id;
  public $backyard_tips;
  public const CONSERVATION_LEVELS = [
    1 => 'Low',
    2 => 'Moderate',
    3 => 'High',
    4 => 'Extreme'
  ];

  /**
   * Creates a Bird object using an array of arguments
   *
   * @param   [array]  $args  An associative array with indexes that correspond to the properties of the Bird object
   *
   * @return  [Bird]             A bird object with properties set to those defined in the input array
   */
  public function __construct($args=[])
  {
    $this->id = $args['id'] ?? NULL;
    $this->common_name = $args['common_name'] ?? NULL;  
    $this->habitat = $args['habitat'] ?? NULL;
    $this->food = $args['food'] ?? NULL;
    $this->nest_placement = $args['nest_placement'] ?? NULL;
    $this->behavior = $args['behavior'] ?? NULL;
    $this->conservation_id = $args['conservation_id'] ?? NULL;
    $this->backyard_tips = $args['backyard_tips'] ?? NULL;  
  }

  /**
   * Returns a string that represents the conservation level of the bird object
   *
   * @return  [string]  The conservation level of the bird
   */
  public function conservation_level(){
    if($this->conservation_id > 0 AND $this->conservation_id) {
      return self::CONSERVATION_LEVELS[$this->conservation_id];
    } else {
      return "Unknown";
    }
  }
}
?>