<?php

class Model_articles extends Model
{
  var $id;
  var $title;
  var $text;
  var $ts;

  function put_data($data)
  {
    $this->title = $data['title'];
    $this->text = $data['text'];

    $mysqli = $this->connect_db();

    $query = "INSERT INTO articles (title, text) VALUES ('$this->title', '$this->text')";
    $result = $mysqli->query($query);
    if ($mysqli->error){
      error_log('put_data error (' . $mysqli->errno . ') '
      . $mysqli->error);
      return false;
    }
    $id = $mysqli->insert_id;

    include_once'application/models/model_tags.php';
    $mod_tags = new model_tags();
    $mod_tags->put_tag($data["tags"], $id);

    $this->id = $id; 
    return $id;  
  }

  function find($id) 
  {

    $mysqli = $this->connect_db();

    $query = "SELECT * FROM articles WHERE id = $id";
    $result = $mysqli->query($query);
    if ($mysqli->error){
      error_log('find error (' . $mysqli->errno . ') '
      . $mysqli->error);
      return false;
    }
  
    if ($result != FALSE) 
    {
      $obj = $result->fetch_object();

      if ($obj == NULL) 
        return "haha";
      $obj->text = explode("[end]", $obj->text);
      $obj->text = implode(" ", $obj->text);
      
      $array_obj = array('id' => $obj->id,
             'title' => $obj->title,
             'text' => $obj->text,
             'ts' => $obj->ts);

      include_once'application/models/model_comments.php';
      $mod_comm = new Model_comments();

      if($comm = $mod_comm->get_comm($id))
        $array_obj['comment'] = $comm;

      include_once'application/models/model_tags.php';
      $mod_tags = new Model_tags();

      if($tags = $mod_tags->get_tags($id))
        $array_obj['tags'] = $tags;      
            
      return $array_obj;
    }
    else
    { 
      return NULL;
    }
  }

  function find_with_tag($tag)
  {
    include_once'application/models/model_tags.php';
    $mod_tags = new Model_tags();

    if($posts = $mod_tags->get_post($tag)){
      $mysqli = $this->connect_db();
      foreach ($posts as $key => $value) {
        $query="SELECT * FROM articles WHERE id = $value"; 
        $result = $mysqli->query($query);
        if ($mysqli->error){
          error_log('find_with_tag error (' . $mysqli->errno . ') '
          . $mysqli->error);

          return false;
        }
        while($obj = $result->fetch_array()){ 
          if(!$obj['text'])
            continue;
          $txt = explode("[end]" ,$obj['text']);
          $obj['text'] = $txt[0];
          $data[] = $obj;
        }

      }
      return $data;
    } 
    return NULL; 
  }

  function get_all() 
  { 
 
    $mysqli = $this->connect_db();

    $query="SELECT * FROM articles"; 
    $result = $mysqli->query($query); 

    if ($mysqli->error){
      error_log('Get_all error (' . $mysqli->errno . ') '
      . $mysqli->error);
      return false;
    }

    while($obj = $result->fetch_array())
    { 
     if(!$obj['text'])
      continue;
     $txt = explode("[end]" ,$obj['text']);
     $obj['text'] = $txt[0];
     $data[] = $obj;
    }  

    $result->close(); 
    $mysqli->close();

  return $data; 
 } 

  function test_data($data)
  {
    $data = trim($data); // удаляет пробелы в начале и конце слова
    $data = stripslashes($data); // удаляет экранирующие символы
    $data = htmlspecialchars($data);
    return $data;
  }

  function edit($data)
  {
    $title = $data['title'];
    $text = $data['text'];
    $id = $data['id'];

   $mysqli = $this->connect_db();

    $query = "UPDATE articles SET title = '$title', text = '$text' WHERE id = '$id'";
    
    $mysqli->query($query);

    if ($mysqli->error){
      error_log('Update error (' . $mysqli->errno . ') '
      . $mysqli->error);
      return false;
    }
    return $id;  
  }

  function delete($index)
  {
   $mysqli = $this->connect_db();

    $query = "DELETE FROM articles
        WHERE id = '$index'";

    $mysqli->query($query);

    if ($mysqli->error){
      error_log('Delete error (' . $mysqli->errno . ') '
      . $mysqli->error);
      return false;
    }

    return $index;

  }


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
}
?>