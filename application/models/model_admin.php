<?php

class Model_admin extends Model
{
	var $id;
	var $title;
	var $text;
	var $ts;

	public function search_admin($name) 
    {
      $query = "SELECT * FROM members WHERE username = ?";
      $stmt = $this->select_query($query, "s", $name);
      return($stmt);
  	}

    public function put_data($username, $email, $password)
  {
    $query = "INSERT INTO members (username, email, password) VALUES (?, ?, ?)";
    $stmt = $this->insert_query($query, "sss", $username, $email, $password);
    
    $id = $stmt->insert_id;
    return $id;  
  }

  public function get_all() 
  { 
 
    $mysqli = $this->connect_db();

    $query="SELECT * FROM members"; 
    $result = $mysqli->query($query); 

    while($arr = $result->fetch_array())
    { 
      $a[] = $arr;
      $data['admin'] = $a;
    }  

    $result->close(); 
    $mysqli->close(); 
    return $data; 
 } 

 public function delete($index)
  {
    $query = "DELETE FROM members
        WHERE id = ?";

    return $this->insert_query($query, "i", $index);    
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
            elseif ($this->search_admin($name)) {
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

  

  function hash($password, $salt)
  {
  	return sha1($salt . $password);
  }

  
} 
