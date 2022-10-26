<?php

/**
 * DatabaseObject View
 *
 * @author Sean Mackey
 */
class DatabaseObject 
{

  static protected $database;
  static protected $table_name = "";
  static protected $db_columns = [];
  public $errors = [];

  /**
   * Sets the database to be used by the DatabaseObject Class
   *
   * @param   [mysqli_connection]  $database  The database to be used for the class
   *
   */
  static public function set_database($database) {
    self::$database = $database;
  }

  /**
   * Uses a prepared sql statement to find a record
   *
   * @param   [mysqli_stmt]  $sql  A prepared mysqli statement
   *
   * @return  [DatabaseObject]     An array of DatabaseObject objects
   */
  static public function find_by_sql($sql) {
    $object_array = [];
    $sql->execute();
    $result = $sql->get_result();
    if(!$result) {
      exit("Database query failed.");
    }
    // results into objects
    
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  /**
   * Returns all records in the table
   *
   * @return  [DatabaseObject]     An array of DatabaseObject objects
   */
  static public function find_all() {
    $sql = self::$database->prepare("SELECT * FROM " . static::$table_name);
    return static::find_by_sql($sql);
  }

  static public function find_by_id($id) {
    $sql = self::$database->prepare("SELECT * FROM " . static::$table_name . " WHERE id= ?");
    $sql->bind_param("s", $id);
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  /**
   * Creates a new DatabaseObject from a record
   *
   * @param   [Array]  $record  An array with key-value pairs that correspond with a DatabaseObject object
   *
   * @return  [DatabaseObject]  A new DatabaseObject created from the key-value pairs in the array
   */
  static protected function instantiate($record) {
    $object = new static;
    // Could manually assign values to properties
    // but automatically assignment is easier and re-usable
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  
  /**
   * Returns an array of every error in the object
   *
   * @return  [array]  An array of errors
   */
  protected function validate() {
    $this->errors = [];

    // Add custom validations

    return $this->errors;
  }
  
  /**
   * Adds an object into the database, returns false if it cannot do so
   *
   * @return  [array]  A result set of the insertion operation
   */
  protected function create() {
    $result = false;
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->attributes();
    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES (";
    // $sql .= join("', '", array_values($attributes));
    // $sql .= "')";
    // $result = self::$database->query($sql);
    $sql .= str_repeat('?, ', count($attributes) - 1);
    $sql .= "?)";
    $stmt = self::$database->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($attributes)), ...array_values($attributes));
    $stmt->execute();
    if(mysqli_stmt_errno($stmt) == 0) {
      $result = true;
    }
    else { 
      $result = false;
    }
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  /**
   * Updates a record in the database for the bike object
   *
   * @return  [array]  Array representing the result of the update operation
   */
  protected function update() {
    $result = false;
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->attributes();

    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}=?";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE id=? ";
    $sql .= "LIMIT 1";
    $args = array_values($attributes);
    $args[] = $this->id;
    $stmt = self::$database->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($attributes)) . 's', ...$args);
    $stmt->execute();
    if(mysqli_stmt_errno($stmt) == 0) {
      $result = true;
    }
    else { 
      $result = false;
    }
    return $result;
  }

  /**
   * Either creates a new database record for an object or updates an existing one
   *
   * @return  [array]  Returns an array representing the result of the save operation
   */
  public function save() {
    // A new record will not have an ID yet
    if(isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  /**
   * A function that updates all of the properties of an object with the contents of a given array
   *
   * @param   [array]  $args  An array with key-value pairs that will be used to update the bike object
   */
  public function merge_attributes($args=[]) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  /**
   * Returns an associative array of key-value pairs for every non-id attribute of the current object
   *
   * @return  [array]  An associative array with key-value pairs for every non-id attribute of the object.
   */
  public function attributes() {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  /**
   * Returns an associative array of key-value pairs for every non-id attribute of the current object with the results sanitized to prevent sql injection
   *
   * @return  [array]  An associative array with key-value pairs for every non-id attribute of the object.
   */
  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }

  
  /**
   * Deletes a record from the database that represents a given object
   *
   * @return  [Array]  An array that represents the result of the delete operation
   */
  public function delete() {
    // $result = false;
    // $sql = "DELETE FROM " . static::$table_name . " ";
    // $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
    // $sql .= "LIMIT 1";
    // $result = self::$database->query($sql);
    $sql = self::$database->prepare("DELETE FROM " . static::$table_name . " WHERE id=? LIMIT 1");
    $sql->bind_param("s", $this->id);
    $sql->execute();
    if(mysqli_stmt_errno($sql) == 0) {
      $result = true;
    }
    else { 
      $result = false;
    }
    return $result;
  }

}

?>
