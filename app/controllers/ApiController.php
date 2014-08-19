<?php
/* 
* @Author: sxf
* @Date:   2014-08-02 20:25:20
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-07 16:23:02
*/

/**
* api class for HHA
*/
class ApiController extends \Phalcon\Mvc\Controller
{

	protected function initialize()
	{
		$this->view->disable(); //阻止显示
	}


	public function indexAction()
	{
		echo "Hello";
	}


	public function regAction()
	{

		$user = new User();

        //Store and check for errors
        $success = $user->save($this->request->getPost(), array('username', 'password'));

        if ($success) {
         	echo $user->id; //输出用户id
        } else {
            foreach ($user->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
	}

	public function logAction()
	{
		
	}

	public function updateAction()
	{
		
	}

	public function getAction()
	{
		
	}	

	
	

}



?>
