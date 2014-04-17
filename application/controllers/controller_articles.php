<?php

session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;

class Controller_articles extends Controller
{

    function action_index()
    {
      $data['articles'] = $this->model_a->get_all();
      $data['tags'] = $this->model_t->all_tags();
      if($_SESSION['admin'] == 1){
        $this->view->generate('articles_view.php', 'tags_view.php', 'template_view.php', $data);
      }
      else    
        $this->view->generate('articles_0.php', 'tags_view.php', 'template_0.php', $data);    
    }

    function action_show($index)
    {
      $data = $this->model_a->find($index);
      
      if ($data != false) {
        $data['tags_to_article'] = $this->model_t->tags_to_article($index);
        $data['tags'] = $this->model_t->all_tags();
        $data['comment'] = $this->model_c->get_comm($index);
        if($_SESSION['admin'] == 1){
          $this->view->generate('show_article_view.php', 'tags_view.php', 'template_view.php', $data);
        }
        else    
          $this->view->generate('show_article_view.php', 'tags_view.php', 'template_0.php', $data);
      }
      else{
        header("Location:/articles/not_found");
      } 
    }

    function action_find($tag)
    {
      $tag = $this->model_a->test_data($tag);
      $data = $this->model_a->find_with_tag($tag);
      $data['tags'] = $this->model_t->all_tags();
      if($_SESSION['admin'] == 1){
        $this->view->generate('find_view.php', 'tags_view.php', 'template_view.php', $data);
      }
      else    
        $this->view->generate('find_0.php', 'tags_view.php', 'template_0.php', $data);

    }
    
    function action_new()
    {	
  
      if ($_SESSION['admin'] != 1) {
        header("Location:/login");
      }
      if (isset($_POST["name"]) && isset($_POST["text"]))
      {
          $data["title"] = $_POST["name"];
          $data["text"] = $_POST["text"];

          $id = $data["id"] = $this->model_a->put_data($data);

          $data["tags_to_article"] = $_POST["tags"];
          $this->model_t->put_tag($data["tags_to_article"], $data["id"]);
          $data['tags'] = $this->model_t->all_tags();

          header("Location:/articles/show/$id");
      }
      else
      {
         $data['tags'] = $this->model_t->all_tags();
      }

        $this->view->generate('articles_new_view.php', 'tags_view.php', 'template_view.php', $data);
  
    } 

    function action_edit($index)
    {
      if ($_SESSION['admin'] != 1) 
        header("Location:/login");
      
      if (!isset($_POST["name"]) && !isset($_POST["text"])){
        $data = $this->model_a->find($index);
        $data['tags_to_article'] = $this->model_t->tags_to_article($index);
        $data['tags_to_article'] = $this->model_a->arr_to_str($data['tags_to_article']);
        $data['tags'] = $this->model_t->all_tags();
        if ($data) 
            $this->view->generate('edit_article_view.php', 'tags_view.php', 'template_view.php', $data);
        else
          header("Location:/articles/not_found)");
         
      }
      else{
        $data["title"] = $_POST["name"];
        $data["text"] = $_POST["text"];
        $data["id"] = $index;
        $this->model_a->edit($data);

        $data["tags_to_article"] = $_POST["tags"];
        $this->model_t->edit_tag($data["tags_to_article"], $index);

        $data['tags'] = $this->model_t->all_tags();

        header("Location:/articles/show/$index");
      }  
    } 

    function action_delete($index)
    {
      if ($_SESSION['admin'] != 1) 
        header("Location:/login");

      $data['tags'] = $this->model_t->all_tags();
    
      if (!isset($_POST["delete"])) 
          $this->view->generate('delete_article_view.php', 'tags_view.php', 'template_view.php', $data);
      else{
        switch ($_POST["delete"]) {
          case 'yes':
            $this->model_a->delete($index);
            $this->model_t->delete($index);
            $this->model_c->delete($index);  
            header("Location:/articles");
            break;
          
          default:
            header("Location:/articles/show/$index");
            break;
        }
      } 
    }  

      function action_not_found()
      { 
        $data['message'] = ":-(";
        $this->view->generate('not_found_view.php', 'message_view.php', 'template_view.php', $data);
      }  		
}
?>