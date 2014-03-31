<?php
class Controller_Main extends Controller
{
   function action_index()
    {
    	session_start();
    	if (!isset($_SESSION['admin'])) 
    			$_SESSION['admin'] = 0;	
        $this->view->generate('main_view.php', 'template_view.php');
    }
}
?>