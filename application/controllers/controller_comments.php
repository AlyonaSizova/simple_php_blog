<?php
class Controller_comments extends Controller
{
    function __construct()
    {
      parent::__construct();
      $this->model_c = new Model_comments();
    }

    function action_new()
    {	
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      
      if (isset($_POST["author_comm"]) && isset($_POST["txt_comm"]))
      {
          $author = $_POST["author_comm"]; 
          $author = $this->model_c->test_data($author);

          $comm = $_POST["txt_comm"]; 
          $comm = $this->model_c->test_data($comm);

          $index = $_POST['id_comm'];

          echo $index;

          $data["comm"] = $comm;
          $data["author"] = $author;
          $data["post"] = $index;

          $id = $this->model_c->put_data($data);

          header("Location:/articles/show/$index");
      }
      else
      {
          header("Location:/articles/show/$index");
      }

    } 
}
?>        