<?php

use Phalcon\Tag;

class IndexController extends ControllerBase
{

	public function initialize()
    {
        // $this->view->setTemplateAfter('main');
        Resource::init($this->assets);
        Tag::setTitle('Welcome');
        parent::initialize();
    }

    /**
     * @Get('/index')
     */
    public function indexAction()
    {
        // $this->view->setVar('login_url','api/log/');
       
    }

    /**
     * @Get('/User')
     */
    public function userAction()
    {
    	# code...
    }

    public function regAction()
    {
    	if (!$this->request->isPost()) {
            $this->flash->notice('This is a sample application of the Phalcon PHP Framework.
                Please don\'t provide us any personal information. Thanks');
        }
    }

}

?>