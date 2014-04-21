<?php
class Controller_comments extends Controller
{
    function action_new()
    {
      $index = $_POST['id_comm'];
      header("Location:/articles/show/$index"); 
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      
      if (isset($_POST["author_comm"]) && isset($_POST["txt_comm"]))
      {
          $author = $_POST["author_comm"]; 
          $author = $this->model_c->test_data($author);

          $comm = $_POST["txt_comm"]; 
          $comm = $this->model_c->test_data($comm);

          $data["comm"] = $comm;
          $data["author"] = $author;
          $data["post"] = $index;

          $id = $this->model_c->put_data($data);
      }
    } 
}
?>