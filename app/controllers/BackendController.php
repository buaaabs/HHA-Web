<?php
/* 
* @Author: sxf
* @Date:   2014-08-07 19:33:45
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-18 12:53:49
*/

/**
* 
*/
class BackendController extends ControllerBase
{
	
	public function initialize()
    {
        // $this->view->setTemplateAfter('backend-temp');
		Phalcon\Tag::setTitle('BackendManager');
        parent::initialize();
    }

	public function indexAction()
	{

		if (isset($_SESSION['user']) && ($_SESSION['user']->auth <> 1))
		{

		} else {
			$_SESSION['user'] = null;
			$this->dispatcher->forward(
    		array(
    			'controller' => 'backend', 
    			'action' => 'login'
    		));
		}
	}


	//此处要创建安全的登陆连接
	public function loginAction()
	{
		// $this->view->setTemplateAfter('blank');
		if ($_SERVER["HTTPS"]<>"on")  
		{  
		$xredir="https://".$_SERVER["SERVER_NAME"].  
		$_SERVER["REQUEST_URI"];  
		header("Location: ".$xredir);  
		}
		$this->view->setVar('login_url','api/log/');
		$this->view->setVar('show_text',''); 
	}

	public function calendarAction()
	{
		
	}

	public function chartAction()
	{
		
	}

	public function filemanagerAction()
	{
		
	}

	public function formAction()
	{
		
	}

	public function galleryAction()
	{
		
	}

	public function iconAction()
	{
		
	}

	public function messagesAction()
	{
		
	}

	public function submenuAction()
	{
		
	}

	public function submenu2Action()
	{
		
	}

	public function submenu3Action()
	{
		
	}

	public function tableAction()
	{	
		
	}

	public function tasksAction()
	{
		
	}

	public function typographyAction()
	{
		
	}

	public function uiAction()
	{
		
	}

	public function widgetsAction()
	{
		
	}


}

?>
