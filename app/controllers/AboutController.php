<?php
/* 
* @Author: sxf
* @Date:   2014-08-06 16:09:11
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-27 16:25:47
*/

/**
* 
*/
class AboutController extends ControllerBase
{
	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('About');
        parent::initialize();
    }

	public function indexAction()
	{
		
	}
}

?>
