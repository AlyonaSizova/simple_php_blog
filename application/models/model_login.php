<?php

class Model_login extends Model
{
	var $id;
	var $title;
	var $text;
	var $ts;

	public function true_admin($name, $email, $password) 
    {

    $mysqli = $this->connect_db();

    if($stmt = $mysqli->prepare(
    	"SELECT * FROM members WHERE email = ? AND username = ? AND password = ?")){
    	$stmt->bind_param("sss", $email, $name, $password);
    	$stmt->execute();
    	$stmt->store_result();
    	$count = $stmt->num_rows;
      //$stmt->free_result();
    	$stmt->close();
    	return($count);
    }
    	return 0;
  	} 

  public function test_data($data)
  {
    $data = trim($data); // удаляет пробелы в начале и конце слова
    $data = stripslashes($data); // удаляет экранирующие символы
    $data = htmlspecialchars($data);
    return $data;
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
