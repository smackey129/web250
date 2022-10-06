<?php 

class Bird {

  static public $database;

  static public function set_database($database) {
    self::$database = $database;
  }

  static public function find_by_sql($sql) {
    $sql->execute();
    $result = $sql->get_result();
    if(!$result) {
      exit("Database query failed.");
    }

    while ($record = $result->fetch_assoc()){
      $object_array[] = self::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  static public function find_all() {
    $sql = self::$database->prepare("SELECT * FROM birds");
    // $sql = "SELECT * FROM birds";
    return self::find_by_sql($sql);
  }

  static protected function instantiate($record) {
    $object = new self;
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  static public function find_by_id($id) {
    $sql = self::$database->prepare("SELECT * FROM birds WHERE id = ?");
    $sql->bind_param('s', $id);
    $obj_array = self::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public $id;
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
    $this->id = $args['id'] ?? NULL;
    $this->common_name = $args['common_name'] ?? NULL;  
    $this->habitat = $args['habitat'] ?? NULL;
    $this->food = $args['food'] ?? NULL;
    $this->nest_placement = $args['nest_placement'] ?? NULL;
    $this->behavior = $args['behavior'] ?? NULL;
    $this->conservation_id = $args['conservation_id'] ?? NULL;
    $this->backyard_tips = $args['backyard_tips'] ?? NULL;  
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