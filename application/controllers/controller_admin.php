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
      $data['message'] = "Хорошего дня, " . $_SESSION['admin_name']; 
      $this->view->generate('admin_view.php', 'message_view.php', 'template_view.php', $data);

    }

    function action_new()
    {	
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;

      if ($_SESSION['admin'] != 1) 
        header("Location:/login");

      $data['message'] = "Хорошего дня, ". $_SESSION['admin_name'];
    
      if(isset($_POST['name'], $_POST['email'], $_POST['password']))
      {
        $valid_name = $this->model_c->valid_name();
        $valid_email = $this->model_c->valid_email();
        $valid_password = $this->model_c->valid_password($valid_email['email']);

        if ($valid_name['valid'] && $valid_email['valid'] && $valid_password['valid']){

          $this->model_c->put_data($valid_name['name'], $valid_email['email'], $valid_password['password']);
          $this->view->generate('success_reg_view.php', 'message_view.php', 'template_view.php', $data);
        }else{

          $data['admin']['name'] = $valid_name['name'];
          $data['admin']['email'] = $valid_email['email'];
          $data['admin']['error_name'] = $valid_name['error'];
          $data['admin']['error_email'] = $valid_email['error'];
          $data['admin']['error_password'] = $valid_password['error'];
          $this->view->generate('admin_new_view.php', 'message_view.php', 'template_view.php', $data);
        } 

      }
      else{
        $data['admin']['name'] = $data['admin']['email'] = $data['admin']['error_name'] = $data['admin']['error_email'] = $data['admin']['error_password'] = " ";
        $this->view->generate('admin_new_view.php', 'message_view.php', 'template_view.php', $data);
      }
    }

    function action_delete($index)
    {
      session_start();
      if (!isset($_SESSION['admin'])) 
          $_SESSION['admin'] = 0;
        
      $data['message'] = "Хорошего дня, " . $_SESSION['admin_name']; 

      if (!isset($_POST["delete"])) 
        $this->view->generate('delete_admin_view.php', 'message_view.php', 'template_view.php', $data);
      else{
        if($_POST["delete"] == 'yes' && $index != "adminushka") 
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