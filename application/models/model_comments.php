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

    $query="SELECT * FROM comments"; 
    $result = $mysqli->query($query); 

    while($arr = $result->fetch_array())
    { 
      $data[] = $arr;
    }  

      $result->close(); 

   $mysqli->close(); 
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
  }

  public function delete($index)
  {
   $mysqli = $this->connect_db();

    $query = "DELETE FROM comments
        WHERE post = '$index'";

    $mysqli->query($query);

    if ($mysqli->error){
      error_log('Delete error (' . $mysqli->errno . ') '
      . $mysqli->error);
    }

  }


}
?>