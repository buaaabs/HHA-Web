<?php
/* 
* @Author: sxf
* @Date:   2014-08-06 16:07:48
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-29 16:53:45
*/

/**
* @RoutePrefix("/Introduce")
*/
class IntroduceController extends ControllerBase
{
	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
    }

    /**
     * @Get('/')
     */
	public function indexAction()
	{
		
	}
}

?>
