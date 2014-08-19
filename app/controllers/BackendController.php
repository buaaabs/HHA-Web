<?php
/* 
* @Author: sxf
* @Date:   2014-08-07 19:33:45
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-08 14:29:27
*/

/**
* 
*/
class BackendController extends ControllerBase
{
	
	public function initialize()
    {
        $this->view->setTemplateAfter('backend-temp');
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
		$this->view->setTemplateAfter('blank');
		if ($_SERVER["HTTPS"]<>"on")  
		{  
		$xredir="https://".$_SERVER["SERVER_NAME"].  
		$_SERVER["REQUEST_URI"];  
		header("Location: ".$xredir);  
		}
		$this->view->setVar('login_url','api/log/');
		$this->view->setVar('show_text',''); 
	}
}

?>
