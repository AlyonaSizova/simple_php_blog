<?php

class Model_login extends Model
{
	var $id;
	var $title;
	var $text;
	var $ts;

	function true_admin($name, $email, $password) 
  {
      $sql = "SELECT * FROM members WHERE email = ? AND username = ? AND password = ?";
      if($this->select_query($sql, "sss", $email, $name, $password)){
        return true;
      }
        return false;
  }

  function filter_input()
  {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = $this->hash($password, $email);
    return $data = array($name, $email, $password);

  }


  function exit_ses()
  {
    // Unset все переменные сессии.
    session_unset();
    // Наконец, разрушить сессию.
    session_destroy();
  }

  function hash($password, $salt)
  {
  	return sha1($salt . $password);
  }

  
} 
