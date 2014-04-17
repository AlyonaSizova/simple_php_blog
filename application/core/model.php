<?php
class Model
{
    function connect_db()
  {
    $blog_config = parse_ini_file("app.ini", true);
    $db=$blog_config['db'];
    $host=$db['host'];
    $user=$db['user'];
    $password=$db['pass'];
    $db_name=$db['db'];
    $mysqli = new mysqli($host, $user, $password, $db_name);

    if ($mysqli->connect_error){
      die('Connect error (' . $mysqli->connect_errno . ') '
      . $mysqli->connect_error);
    }

    return $mysqli;

  }

  function insert_query($sql)
  {
    $mysqli = $this->connect_db();

    $args = func_get_args();
    $sql = $args[0];

    array_shift($args);
 
    $args = array_map(function ($param) {
      return $this->test_data($param);
    },$args);

    $stmt = $mysqli->stmt_init();

    if($stmt->prepare($sql)){
  
      call_user_func_array(array($stmt,'bind_param'), $this->makeValuesReferenced($args));
      if($stmt->execute())
        
        return $stmt;
    }  
    return false;
  }

  function select_query($sql)
  {
    $mysqli = $this->connect_db();

    $args = func_get_args();
    $sql = $args[0];

    array_shift($args);
 
    $args = array_map(function ($param) {
      return $this->test_data($param);
    },$args);

    if ($stmt = $mysqli->prepare($sql)) {
      call_user_func_array(array($stmt,'bind_param'), $this->makeValuesReferenced($args));
      $stmt->execute();
      
      $meta = $stmt->result_metadata(); 

      while ($field = $meta->fetch_field()){ 
        $params[] = &$row[$field->name]; 
      } 

      call_user_func_array(array($stmt, 'bind_result'), $params);
      $result = array();
      while ($stmt->fetch()) {
        foreach($row as $key => $val){ 
            $c[$key] = $val; 
        } 
        $result[] = $c; 
      } 
      return $result;
      $stmt->close(); 
    }
  return false;
  } 
   
   function prepare_query($sql)
  {
    $mysqli = $this->connect_db();

    $args = func_get_args();
    $sql = $args[0];

    array_shift($args);

    if ($stmt = $mysqli->prepare($sql)) {
      $result = array();
      foreach ($args[1] as $key => $value) {
        $argum = array($args[0], $value);
        
        $argum = array_map(function ($param) {
              return $this->test_data($param);},$argum);

        call_user_func_array(array($stmt,'bind_param'), $this->makeValuesReferenced($argum));
        $stmt->execute();
        $meta = $stmt->result_metadata(); 
        $params = array();
        while ($field = $meta->fetch_field()){ 
          $params[] = &$row[$field->name]; 
        } 

        call_user_func_array(array($stmt, 'bind_result'), $params);
    
        while ($stmt->fetch()) {
          foreach($row as $key => $val){ 
            $c[$key] = $val; 
          } 
          $result[] = $c; 
        } 

      }
      return $result;
      $stmt->close(); 
    }
    return false;
  } 

  function test_data($data)
  {
    $data = trim($data); // удаляет пробелы в начале и конце слова
    $data = stripslashes($data); // удаляет экранирующие символы
    $data = htmlspecialchars($data);
    return $data;
  }

  function makeValuesReferenced($arr)
  {
    $refs = array();
    foreach($arr as $key => $value)
        $refs[$key] = &$arr[$key];
    return $refs;
  } 

  function arr_to_str($array)
 {
  if (isset($array)) {
    $str = implode(", ", $array);
  }
  else $str = " ";

  return $str;
 }  
}
?>