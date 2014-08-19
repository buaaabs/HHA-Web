<?php

class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
    }

    public function indexAction()
    {
		$this->view->setVar('login_url','api/log/');
    }

    public function signupAction()
    {

       
    }

    public function signupextAction()
    {

       
    }

}
?>