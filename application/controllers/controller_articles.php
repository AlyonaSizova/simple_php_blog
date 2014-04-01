<?php
class Controller_articles extends Controller
{
    function __construct()
    {
      parent::__construct();
      $this->model_c = new Model_articles();
    }

    function action_index()
    {
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      $data = $this->model_c->get_all();
      if($_SESSION['admin'] == 1){
        $this->view->generate('articles_view.php', 'template_view.php', $data);
      }
      else    
        $this->view->generate('articles_view.php', 'template_0.php', $data);    
    }

    function action_show($index)
    {
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      $data = $this->model_c->find($index);
      //$data = serialize($data);
    
      if ($data != "haha") {
        if($_SESSION['admin'] == 1){
          $this->view->generate('show_article_view.php', 'template_view.php', $data);
        }
        else    
          $this->view->generate('show_article_view.php', 'template_0.php', $data);
      }
      else{
        header("Location:/articles/not_found");
      } 
    }

    function action_find($tag)
    {
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      $tag = $this->model_c->test_data($tag);
      $data = $this->model_c->find_with_tag($tag);
      if($_SESSION['admin'] == 1){
        $this->view->generate('articles_view.php', 'template_view.php', $data);
      }
      else    
        $this->view->generate('articles_view.php', 'template_0.php', $data);

    }
    
    function action_new()
    {	
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      if ($_SESSION['admin'] != 1) {
        $_SESSION['admin'] == 0;
        header("Location:/login");
      }
      if (isset($_POST["name"]) && isset($_POST["text"]))
      {
          $title = $_POST["name"]; 
          $title = $this->model_c->test_data($title);

          $text = $_POST["text"]; 
          $text = $this->model_c->test_data($text);

          $tags = $_POST["tags"];
          $tags = $this->model_c->test_data($tags);

          $data["title"] = $title;
          $data["text"] = $text;
          $data["tags"] = $tags;

          $id = $this->model_c->put_data($data);

          $data["id"] = $id;
          header("Location:/articles/show/$id");
      }
      else
      {
         $data["text"] = "";
         $data["title"] = "";
      }
      if($_SESSION['admin'] == 1){
        $this->view->generate('articles_new_view.php', 'template_view.php', $data);
      }
      else    
        $this->view->generate('articles_new_view.php', 'template_0.php', $data);
    } 

    function action_edit($index)
    {
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      if ($_SESSION['admin'] != 1) {
        $_SESSION['admin'] == 0;
        header("Location:/login");
      }
      if (!isset($_POST["name"]) && !isset($_POST["text"])){
        $data = $this->model_c->find($index);
        if ($data) {
          if($_SESSION['admin'] == 1){
            $this->view->generate('edit_article_view.php', 'template_view.php', $data);
          }
          else    
            $this->view->generate('edit_article_view.php', 'template_0.php', $data);
        }
        else{
          header("Location:/articles/not_found)");
        }  
      }
      else{
        $title = $_POST["name"]; 
        $title = $this->model_c->test_data($title);

        $text = $_POST["text"]; 
        $text = $this->model_c->test_data($text);

        $data["title"] = $title;
        $data["text"] = $text;
        $data["id"] = $index;

        $this->model_c->edit($data);

        header("Location:/articles/show/$index");
      }  
    } 

    function action_delete($index)
    {
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      if ($_SESSION['admin'] != 1) {
        $_SESSION['admin'] == 0;
        header("Location:/login");
      }
      if (!isset($_POST["delete"])) {
        if($_SESSION['admin'] == 1){
          $this->view->generate('delete_article_view.php', 'template_view.php', $data);
        }
        else    
          $this->view->generate('delete_article_view.php', 'template_0.php', $data);
      }
      else{
        switch ($_POST["delete"]) {
          case 'yes':
            $data = $this->model_c->delete($index);
            header("Location:/articles");
            break;
          
          default:
            header("Location:/articles/show/$index");
            break;
        }
      } 

      function action_not_found()
      {
        session_start();
        if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
        $this->view->generate('not_found_view.php', 'template_view.php');
      } 

    }			
}
?>