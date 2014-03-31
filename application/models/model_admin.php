<?php

class Model_admin extends Model
{
	var $id;
	var $title;
	var $text;
	var $ts;

	public function search_admin($name) 
    {

    $mysqli = $this->connect_db();

    $query = "SELECT * FROM members WHERE username = ?";
    if($stmt = $mysqli->prepare($query)){
    	$stmt->bind_param('s', $name);
    	$stmt->execute();
      $stmt->store_result();
    	$count = $stmt->affected_rows;
      $stmt->free_result();
    	$stmt->close();
    	return($count);
    }

    	return false;
  	}

    public function put_data($username, $email, $password)
  {

    $mysqli = $this->connect_db();

    $query = "INSERT INTO members (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = $mysqli->query($query);
    $id = $mysqli->insert_id;
    $this->id = $id;
    return $id;  
  }

  public function get_all() 
  { 
 
    $mysqli = $this->connect_db();

    $query="SELECT * FROM members"; 
    $result = $mysqli->query($query); 

    while($obj = $result->fetch_array())
    { 
      $data[] = $obj;
      /*echo "obj:<br>"; 
      echo print_r($obj); 
      echo "<br>"; 
      $line.=$obj->uid; 
      $line.=$obj->role; 
      $line.=$obj->roleid; */
    }  

      $result->close(); 


   $mysqli->close(); 
   return $data; 
 } 

 public function delete($index)
  {
   $mysqli = $this->connect_db();

    $query = "DELETE FROM members
        WHERE id = '$index'";

    error_log($query);
    $mysqli->query($query);

    if ($mysqli->error){
      error_log('Delete error (' . $mysqli->errno . ') '
      . $mysqli->error);
    }

  }

  function valid_name()
        {
          if ($name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)) {
            if (strlen($name) > 20) {
              return array('valid' => false, 'error' => "login is more then 20 symbols", 'name' => $name);
            }
            elseif (strlen($name) < 4){
              return array('valid' => false, 'error' => "login is too short", 'name' => $name);
            }
            elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",$name)) {
              return array('valid' => false, 'error' => "only letters and digits allowed", 'name' => $name);
            }
            elseif ($this->search_admin($name) != 0) {
              return array('valid' => false, 'error' => "user with such login already exists", 'name' => $name);
            }
            else
              return array('valid' => true, 'error' => " ", 'name' => $name);
          }
          return array('valid' => false, 'error' => "invalid name", 'name' => $name);
        }

        function valid_email()
        {
          if ($email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) {
            if (!$email = filter_var($email, FILTER_VALIDATE_EMAIL)) 
              return array('valid' => false, 'error' => "not valid email", 'email' => $email);
            return array('valid' => true, 'error' => " ", 'email' => $email);
          }
          return array('valid' => false, 'error' => "invalid email", 'email' => $email);
        }

        function valid_password($email)
        {
          if ($password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)) {
            if (strlen($password) < 5)
              return array('valid' => false, 'error' => "password is too short", 'password' => $password); 
            else
              $password = $this->hash($password, $email);
            if (strlen($password) == 40) {
              return array('valid' => true, 'error' => " ", 'password' => $password);
            }
            return array('valid' => false, 'error' => "invalid password", 'password' => $password);  
          }
          return array('valid' => false, 'error' => "invalid password", 'password' => $password);
        } 

  public function test_data($data)
  {
    $data = trim($data); // удаляет пробелы в начале и конце слова
    $data = stripslashes($data); // удаляет экранирующие символы
    $data = htmlspecialchars($data);
    return $data;
  }

  function hash($password, $salt)
  {
  	return sha1($salt . $password);
  }

  public function connect_db()
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
} 
