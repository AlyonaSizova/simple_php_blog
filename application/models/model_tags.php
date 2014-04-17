<?php

class Model_tags extends Model
{

  function put_tag($tags, $post)
  {
    if($tags == NULL)
      return NULL;

    $tags = explode(",", $tags);

    foreach ($tags as $key => $value) {

      if (!$this->exist_tag($value, $post)) {
        $query = "INSERT INTO tags (post, tag) VALUES (?, ?)";
        if(!$this->insert_query($query, "is", $post, $value))
          return false;
        
      }
    }
    return NULL;
  }

  function exist_tag($tag, $post)
  {
      $query = "SELECT * FROM tags WHERE tag = ? AND post = ?";
      return $this->select_query($query, "si", $tag, $post);
  }

  function tags_to_article($post) 
  {
    $tags = array();
    $query = "SELECT tag FROM tags WHERE post = ?";
    
    $arr = $this->select_query($query, "i", $post); 

    foreach ($arr as $key => $value) {
      $tags[] = $value['tag'];
    }
    return $tags;
  }

  function get_post($tag)
  {
    $query="SELECT post FROM tags WHERE tag = ?";
    $arr = $this->select_query($query, "s", $tag);
    
    $num = 0;
    foreach ($arr as $key => $value) {
      $data[] = $value['post'];
      $num++;
    }
    $data['message'] = $num;
    return $data;

  }

  function all_tags() 
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

 

  public function edit_tag($data, $post)
  {
    $this->delete($post);
    $result = $this->put_tag($data, $post);
    
    return $result;
  }

  public function delete($index)
  {
    $query = "DELETE FROM tags WHERE post = ?";
    return $this->insert_query($query, "i", $index);

  }



}
?>