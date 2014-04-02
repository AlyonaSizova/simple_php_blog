<?php

class Model_comments extends Model
{
	
	
  function put_data($data)
	{
		$author = $data['author'];
  	$comm = $data['comm'];
    $post = $data['post'];

  	$mysqli = $this->connect_db();

  	$query = "INSERT INTO comments (author, comm, post) VALUES ('$author', '$comm', $post)";
  	$result = $mysqli->query($query);
  	$id = $mysqli->insert_id;
  	$this->id = $id;
    return $id;  
	}

  public function get_comm($id) 
  {

    $mysqli = $this->connect_db();

    $query = "SELECT * FROM comments WHERE post = '$id'";
    $result = $mysqli->query($query);
    $data = NULL;

  
    if ($result) 
    {
      while($obj = $result->fetch_array())
        $data[] = $obj;

      return $data;
    }
    else
    { 
      return NULL;
    }
  }

  public function get_all() 
  { 
 
    $mysqli = $this->connect_db();

    $query="SELECT * FROM articles"; 
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

  public function test_data($data)
  {
    $data = trim($data); // удаляет пробелы в начале и конце слова
    $data = stripslashes($data); // удаляет экранирующие символы
    $data = htmlspecialchars($data);
    return $data;
  }

  public function edit($data)
  {
    $title = $data['title'];
    $text = $data['text'];
    $id = $data['id'];

   $mysqli = $this->connect_db();

    $query = "UPDATE articles SET title = '$title', text = '$text' WHERE id = '$id'";
    error_log($query);
    $mysqli->query($query);

    if ($mysqli->error){
      error_log('Update error (' . $mysqli->errno . ') '
      . $mysqli->error);
    }
    //$id = $mysqli->insert_id;
    //$this->id = $id;
    //return $id;  
  }

  public function delete($index)
  {
   $mysqli = $this->connect_db();

    $query = "DELETE FROM articles
        WHERE id = '$index'";

    error_log($query);
    $mysqli->query($query);

    if ($mysqli->error){
      error_log('Delete error (' . $mysqli->errno . ') '
      . $mysqli->error);
    }

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
?>