<?php
session_start();
        if (!isset($_SESSION['admin'])) 
                $_SESSION['admin'] = 0;
                
class Controller_Main extends Controller
{
   function action_index()
    {
    	
        $data['message'] = "Добро пожаловать!";    
    	if ($_SESSION['admin'] == 1) {
    		$this->view->generate('main_view.php', 'message_view.php', 'template_view.php', $data);		
    	}
    	else			
        	$this->view->generate('main_view.php', 'message_view.php', 'template_0.php', $data);
    }
}
?>