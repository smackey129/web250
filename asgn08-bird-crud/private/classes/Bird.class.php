<?php 

class Bird {

  static public $database;
  static protected $db_columns = ['id', 'common_name', 'habitat', 'food', 'conservation_id', 'backyard_tips'];
  public $errors = [];

  /**
   * Sets the database used for the Bird Class
   *
   * @param   [mysqli]  $database  The database object to be used for the bird class
   */
  static public function set_database($database) {
    self::$database = $database;
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->common_name)) {
      $this->errors[] = "Common Name cannot be blank";
    }
    return $this->errors;
  }

  /**
   * A function that executes a prepared sql statement and returns an array of the results
   *
   * @param   [prepared statement]  $sql  A prepared sql statement that will be executed
   *
   * @return  [array]        An array of Bird objects from the sql statement
   */
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

  /**
   * Returns an array of all records in the birds table of the database
   *
   * @return  [array]  An array containing bird objects representing all records in the birds able
   */
  static public function find_all() {
    $sql = self::$database->prepare("SELECT * FROM birds");
    // $sql = "SELECT * FROM birds";
    return self::find_by_sql($sql);
  }

  /**
   * Creates a Bird object from an associative array
   *
   * @param   [array]  $record  An associative array that corresponds with the properties of a bird object
   *
   * @return  [Bird]           A bird object created from the data in the record array
   */
  static protected function instantiate($record) {
    $object = new self;
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }
  /**
   * Returns a bird object from the database with the selected id, or returns false if the id number does not exist.
   *
   * @param   [string]  $id  The id number of the bird in the database
   *
   * @return  [Bird]         A bird object with the corresponding id number, or false if there is no bird with that id number.
   */
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

  public function save() {
    // A new record will not have an ID yet
    if(isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  public function create() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO birds (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  public function update() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE birds SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  public function delete() {
    $sql = "DELETE FROM birds ";
    $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  public function attributes() {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }

  public function merge_attributes($args=[]) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
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