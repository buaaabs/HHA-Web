<?php
/* 
* @Author: sxf
* @Date:   2014-08-06 16:09:11
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-17 15:40:49
*/

/**
* 
*/
class AboutController extends ControllerBase
{
	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Welcome');
        $a = new UserExt();
        parent::initialize();
    }

	public function indexAction()
	{
		
	}
}

?>
