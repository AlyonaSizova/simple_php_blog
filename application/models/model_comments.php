<?php

class Model_comments extends Model
{
	
	
  function put_data($data)
	{
  	$query = "INSERT INTO comments (author, comm, post) VALUES (?, ?, ?)";

    $stmt = $this->insert_query($query, "ssi", $data['author'], $data['comm'], $data['post']);
    return $stmt->insert_id;
	}

  public function get_comm($id) 
  {

    $query = "SELECT * FROM comments WHERE post = ?";
   
    return $this->select_query($query, "i", $id);
  
  }

  public function delete($index)
  {

    $query = "DELETE FROM comments
        WHERE post = ?";
    return $this->insert_query($query, "i", $index);    
  }


}
?>