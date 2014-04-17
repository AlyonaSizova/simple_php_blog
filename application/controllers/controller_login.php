<?php

class Controller_login extends Controller
{
	function __construct()
    {
      parent::__construct();
    }
	
	function action_index()
	{
		session_start();
		if (!isset($_SESSION['admin'])) 
    			$_SESSION['admin'] = 0;

		if(isset($_POST['name'], $_POST['email'], $_POST['password']))
		{
			$input = $this->model_l->filter_input();

			$admin = $this->model_l->true_admin($input[0], $input[1], $input[2]);
		
			if($admin){
				$_SESSION['admin'] = 1;
				$_SESSION['admin_name'] = $input[0];
				header('Location:/articles');
			}
			else
				$data['message'] = "Войти не удалось";
				$this->view->generate('login_view.php', 'message_view.php', 'template_0.php', $data);
 
		}
		else
		{
			$data['message'] = "Добро пожаловать!";
			$this->view->generate('login_view.php', 'message_view.php', 'template_0.php', $data);
		}
		
		
	}

	function action_exit()
	{
		session_start();
		$data['message'] = "Всего доброго!";
		if (!isset($_SESSION['admin'])) 
    			$_SESSION['admin'] = 0;
      	if ($_SESSION['admin'] != 1) {
        	$_SESSION['admin'] == 0;
        	header("Location:/login");
      	}
      	if (!isset($_POST["exit"])) {
      		if($_SESSION['admin'] == 1){
        		$this->view->generate('exit_view.php', 'message_view.php', 'template_view.php', $data);
      		}
      		else    
        		$this->view->generate('exit_view.php', 'message_view.php', 'template_0.php', $data);
      	}
      	else{
        	switch ($_POST["exit"]) {
          case 'yes':
            $data = $this->model_l->exit_ses();
            header("Location:/articles");
            break;
          
          default:
            header("Location:/admin");
            break;
        	}
        }
	}	
}
?>