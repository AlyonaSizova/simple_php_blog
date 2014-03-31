<?php

class Controller_login extends Controller
{
	function __construct()
    {
      parent::__construct();
      $this->model_c = new Model_login();
    }
	
	function action_index()
	{
		$data["login_status"] = "";
		session_start();
		if (!isset($_SESSION['admin'])) 
    			$_SESSION['admin'] = 0;

		if(isset($_POST['name'], $_POST['email'], $_POST['password']))
		{
			// Sanitize and validate the data passed in
    		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
    		$email = $this->model_c->test_data($email);

    		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        		echo "not valid mail";
   			}
			$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
			$password = $this->model_c->hash($password, $email);

			$admin = $this->model_c->true_admin($name, $email, $password);
		
			if($admin == 1)
			{
				echo "string";
				session_start();
				$_SESSION['admin'] = 1; 
				//echo $_SESSION['admin'];
				header('Location:/articles');
			}
			else
			{
				echo $admin;
				echo $password;
				$_SESSION['admin'] = 0;
				$this->view->generate('login_view.php', 'template_view.php');
 
			}
		}
		else
		{
			$this->view->generate('login_view.php', 'template_view.php', $data);
		}
		
		
	}

	function action_exit()
	{
		session_start();
		if (!isset($_SESSION['admin'])) 
    			$_SESSION['admin'] = 0;
      	if ($_SESSION['admin'] != 1) {
        	$_SESSION['admin'] == 0;
        	header("Location:/login");
      	}
      	if (!isset($_POST["exit"])) {
        	$this->view->generate('exit_view.php', 'template_view.php');
      	}
      	else{
        	switch ($_POST["exit"]) {
          case 'yes':
            $data = $this->model_c->exit_ses();
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