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

    if ($result != false) 
    {
      $obj = $result->fetch_object();

      if ($obj == NULL) 
        return "haha";

      $obj->text = explode("[end]", $obj->text);
      $obj->text = implode(" ", $obj->text);
      
      $data['articles'] = array('id' => $obj->id,
             'title' => $obj->title,
             'text' => $obj->text,
             'ts' => $obj->ts);

      return $data;
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
      $data['message'] = $posts['message'];
      unset($posts['message']);
      if ($data['message'] != 0) {
        $mysqli = $this->connect_db();
        foreach ($posts as $key => $value) {
          $query="SELECT * FROM articles WHERE id = $value"; 
          $result = $mysqli->query($query);
          if ($mysqli->error){
            error_log('find_with_tag error (' . $mysqli->errno . ') '
            . $mysqli->error);

            return false;
          }
          while($arr = $result->fetch_array()){ 
            if(!$arr['text'])
              continue;
            $txt = explode("[end]" ,$arr['text']);
            $arr['text'] = $txt[0];
            $a[] = $arr;
            $data['articles'] = $a;
          }
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

  function edit($data)
  {
    $title = $this->test_data($data['title']);
    $text = $this->test_data($data['text']);
    $id = $this->test_data($data['id']);

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
}
?>