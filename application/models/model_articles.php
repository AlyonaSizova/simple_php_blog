<?php

class Model_articles extends Model
{
  var $id;
  var $title;
  var $text;
  var $ts;

  function put_data($data)
  {
    $title = $data['title'];
    $text = $data['text'];

    $query = "INSERT INTO articles (title, text) VALUES (?, ?)";
    $stmt = $this->insert_query($query, "ss", $title, $text);
    
    return $stmt->insert_id; 
  }

  function find($id) 
  {
    $query = "SELECT * FROM articles WHERE id = ?";

    if ($arr = $this->select_query($query, "i", $id)) {
      $arr = $arr[0];
      $arr['text'] = explode("[end]", $arr['text']);
      $arr['text'] = implode(" ", $arr['text']);
      $data['articles'] = array('id' => $arr['id'],
             'title' => $arr['title'],
             'text' => $arr['text'],
             'ts' => $arr['ts']);

      return $data;
    }

    return NULL;
      
  }

  function find_with_tag($tag)
  {
    include_once'application/models/model_tags.php';
    $mod_tags = new Model_tags();

    if($posts = $mod_tags->get_post($tag)){
      $data['message'] = $posts['message'];
      unset($posts['message']);
      if ($posts) {

          $query="SELECT * FROM articles WHERE id = ?"; 

         $arr = $this->prepare_query($query, "i", $posts);
          foreach ($arr as $key => $value) {

             if(!$value['text'])
               continue;
            $txt = explode('[end]' ,$value['text']);
            $arr[$key]['text'] = $txt[0];
            
           }

          $data['articles'] = $arr;

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
    $title = $data['title'];
    $text = $data['text'];
    $id = $data['id'];

    $query = "UPDATE articles SET title = ?, text = ? WHERE id = ?";
    $this->insert_query($query, "ssi", $title, $text, $id);
    return $id;  
  }

  function delete($index)
  {
    $query = "DELETE FROM articles
        WHERE id = ?";
    return $this->insert_query($query, "i", $index);

  }
}
?>