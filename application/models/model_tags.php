<?php

class Model_tags extends Model
{

  function put_tag($tags, $post)
  {
    if($tags == NULL)
      return NULL;

    $mysqli = $this->connect_db();

    $tags = explode(",", $tags);

    foreach ($tags as $key => $value) {
      $value = $this->test_data($value);

      if (!$this->exist_tag($value, $post)) {
        $query = "INSERT INTO tags (post, tag) VALUES ('$post', '$value')";
        $result = $mysqli->query($query);
        if ($mysqli->error){
          error_log('Put_tag error (' . $mysqli->errno . ') '
          . $mysqli->error);
          return false;
        }
      }
    }

      return NULL;
  }

  function exist_tag($tag, $post)
  {
    $mysqli = $this->connect_db();

    if($stmt = $mysqli->prepare(
      "SELECT * FROM tags WHERE tag = ? AND post = ?")){
      $stmt->bind_param("ss", $tag, $post);
      $stmt->execute();
      $stmt->store_result();
      $count = $stmt->num_rows;
      //$stmt->free_result();
      $stmt->close();
      return($count);
    }
      return 0;
  }

  public function get_tags($post) 
  {

    $mysqli = $this->connect_db();

    $query = "SELECT * FROM tags WHERE post = $post";
    $result = $mysqli->query($query);
    $data = NULL;
    if ($result) 
    {
      
      while($obj = $result->fetch_array())  
        $data[] = $obj['tag'];  

      $result->close(); 
      $mysqli->close(); 
   
      return $data; 
    }
    else
    { 
      return NULL;
    }
  }

  function get_post($tag)
  {
    $mysqli = $this->connect_db();
    $data = NULL;

    $query="SELECT * FROM tags WHERE tag = '$tag'";
    if (!($result = $mysqli->query($query))) {
        printf("Error: %s\n", $mysqli->error);
    }

    $num = $result->num_rows;
    $data['message'] = $num;

    while($obj = $result->fetch_array())
    { 
      $data[] = $obj['post'];
    
    }  

      $result->close(); 
      $mysqli->close(); 
      return $data; 

  }

  function get_all() 
  { 
 
    $mysqli = $this->connect_db();

    $query="SELECT DISTINCT tag FROM tags"; 
    $result = $mysqli->query($query); 

    while($obj = $result->fetch_array())
    { 
      
      $data[] = $obj['tag'];
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