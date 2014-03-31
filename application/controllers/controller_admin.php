<?php
class Controller_admin extends Controller
{
    function __construct()
    {
      parent::__construct();
      $this->model_c = new Model_admin();
    }

    function action_index()
    {
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      if ($_SESSION['admin'] != 1)
        header("Location:/login");

      $data = $this->model_c->get_all(); 
      $this->view->generate('admin_view.php', 'template_view.php', $data);

    }

    /*function action_show($index)
    {
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      $data = $this->model_c->find($index);
      //$data = serialize($data);
    
      if ($data != "haha") {
        $this->view->generate('show_article_view.php', 'template_view.php', $data);
      }
      else{
        $_SESSION['admin'] == 0;
      } 
    }*/
    
    function action_new()
    {	
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;

      if ($_SESSION['admin'] != 1) 
        header("Location:/login");
    
      if(isset($_POST['name'], $_POST['email'], $_POST['password']))
      {
        // Sanitize and validate the data passed in
        $valid_name = $this->model_c->valid_name();
        $valid_email = $this->model_c->valid_email();
        $valid_password = $this->model_c->valid_password($valid_email['email']);

        if ($valid_name['valid'] && $valid_email['valid'] && $valid_password['valid']){

          $this->model_c->put_data($valid_name['name'], $valid_email['email'], $valid_password['password']);
          $this->view->generate('success_reg_view.php', 'template_view.php');
        }else{

          $data['name'] = $valid_name['name'];
          $data['email'] = $valid_email['email'];
          $data['error_name'] = $valid_name['error'];
          $data['error_email'] = $valid_email['error'];
          $data['error_password'] = $valid_password['error'];
          $this->view->generate('admin_new_view.php', 'template_view.php', $data);
        } 

      }
      else{
        $data['name'] = $data['email'] = $data['error_name'] = $data['error_email'] = $data['error_password'] = " ";
        $this->view->generate('admin_new_view.php', 'template_view.php', $data);
      }
    }

    function action_delete($index)
    {
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
      if (!isset($_POST["delete"])) 
        $this->view->generate('delete_admin_view.php', 'template_view.php');
      else{
        if($_POST["delete"] == 'yes' && $name != "adminushka") 
            $data = $this->model_c->delete($index);
        header("Location:/admin");
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
?>