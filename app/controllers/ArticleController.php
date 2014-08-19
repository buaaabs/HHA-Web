<?php
/* 
* @Author: sxf
* @Date:   2014-08-06 15:22:46
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-07 17:52:25
*/

/**
* 这个类主要是用来控制显示网站文章的
*/
class ArticleController extends ControllerBase
{
	

	public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Welcome');
        parent::initialize();
    }

	public function indexAction()
	{
		echo $this->guid();
		$this->view->disable(); //阻止显示
	}


	public function detailsAction($id=null)
	{
		if ($id == null)
		{
			$this->dispatcher->forward(
    		array(
    			'controller' => 'article', 
    			'action' => 'index'
    		));
			return;
		} else {

			// Query string binding parameters with string placeholders
			$conditions = "id = :str:";

			//Parameters whose keys are the same as placeholders
			$parameters = array(
			    "str" => $id
			);
			$article = Article::findFirst(array(
			    $conditions,
			    "bind" => $parameters
			));
			$this->view->setVar('article_title',$article->title);
			$this->view->setVar('article_date',$article->date);
			$this->view->setVar('article_body',$article->body);
				
		}
	}

	public function guid() {
	    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
	    $uuid =
	    substr($charid, 0, 8).
	    substr($charid, 8, 4).
	    substr($charid,12, 4).
	    substr($charid,16, 4).
	    substr($charid,20,12);
	    return $uuid;
	}	

	public function addAction()
	{
		
	}

	public function changeAction()
	{
		# code...
	}

	public function deleteAction()
	{
		# code...
	}

	public function editAction($id)
	{
		if ($id=='new')
		{

		}else{

		}
	}

}

?>
