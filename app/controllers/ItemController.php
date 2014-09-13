<?php
/* 
* @Author: sxf
* @Date:   2014-09-01 18:49:58
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-03 12:38:13
*/
use Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\InclusionIn,
    Phalcon\Validation\Validator\Regex;

/** 
* @RoutePrefix("/Item")
*/
class ItemController extends \Phalcon\Mvc\Controller
{

	public function initialize()
	{
		$this->view->disable(); //阻止显示
		$this->response->setHeader("Content-Type", "application/json; charset=utf-8");
	}

	public function addAction()
	{
		$ans = [];
		try {
			if (!$this->request->isPost()){
				throw new Exception('请用正确的方式访问我们的API', 99);
			}
			$validation = new Phalcon\Validation();
			$validation->add('name',new PresenceOf([
				'message'=>'name is needed']));
			$validation->add('name',new StringLength([
				'max' => 50,
				'messageMaximum' => 'The name is too long.'
				]));
			$validation->add('name',new MyRegex());
			
			$validation->add('unit',new StringLength([
				'max' => 10,
				'messageMaximum' => 'The unit is too long.'
				]));
			$validation->add('unit',new MyRegex());
			$validation->add('user_group',new PresenceOf([
				'message'=>'user_group is needed']));
			$validation->add('type',new InclusionIn([
				'message' => 'The status must be 0 or 1',
				'domain' => array(0, 1)
   				]));
   			$validation->add('user_group',new Regex([
   				'pattern' => '/[0-9]{1,10}/u',
   				'message' => 'user_group need a number'
   				]));

			$messages = $validation->validate($_POST);
			foreach ($messages as $message) {
				throw new Exception($message,102);
		    }

		    //获取Post中的内容，然后将name存入到数据库中
			$name = $this->request->getPost('name');
			$unit = $this->request->getPost('unit');
			$type = $this->request->getPost('type');
			$user_group = $this->request->getPost('user_group');

			$item = new Item();
			$item->name = $name;
			$item->unit = $unit;
			$item->type = $type;
			$item->user_group = $user_group;
			$success = $item->save();
			if ($success) {
				$ans['id'] = $item->id;
			} else {
				foreach ($item->getMessages() as $message) {
					throw new Exception($message, 100);
				}
			}
		} catch(Exception $e) {
			$ans['id'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
		
	}

	public function deleteAction()
	{
		$ans = [];
		try {
			if (!$this->request->isPost()){
				throw new Exception('请用正确的方式访问我们的API', 99);
			}
			$validation = new Phalcon\Validation();
			$validation->add('id',new PresenceOf([
				'message'=>'id is needed.']));
			$validation->add('id',new Regex([
				'pattern' => '/[0-9]{1,10}/u',
				'message' => 'please give us a number.'
				]));
			$messages = $validation->validate($_POST);
			foreach ($messages as $message) {
				throw new Exception($message,102);
		    }

		    $id = $this->request->getPost('id');
		    $item = Item::findFirst($id);
		    if ($item == null) throw new Exception('id is not find', 1201);
		    $succeed = $item->delete();
		    if ($succeed) {
		    	$ans['ret'] = 0;
		    } else {
		    	foreach ($item->getMessages() as $message) {
					throw new Exception($message, 100);
				}
		    }

		} catch(Exception $e) {
			$ans['id'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}

	public function updateAction($id)
	{
		$ans = [];
		try {
			if (!$this->request->isPost()){
				throw new Exception('请用正确的方式访问我们的API', 99);
			}
			$validation = new Phalcon\Validation();
			$validation->add('name',new PresenceOf([
				'message'=>'name is needed']));
			$validation->add('name',new StringLength([
				'max' => 50,
				'messageMaximum' => 'The name is too long.'
				]));
			$validation->add('name',new MyRegex());
			$validation->add('unit',new StringLength([
				'max' => 10,
				'messageMaximum' => 'The unit is too long.'
				]));
			$validation->add('unit',new MyRegex());
			$validation->add('user_group',new PresenceOf([
				'message'=>'user_group is needed']));
			$validation->add('type',new InclusionIn([
				'message' => 'The status must be 0 or 1',
				'domain' => array(0, 1)
   				]));
   			$validation->add('user_group',new Regex([
   				'pattern' => '/[0-9]{1,10}/u',
   				'message' => 'user_group need a number'
   				]));
   			$validation->add('id',new PresenceOf([
				'message'=>'id is needed.']));
			$validation->add('id',new Regex([
				'pattern' => '/[0-9]{1,10}/u',
				'message' => 'please give us a number.'
				]));
			$_POST['id'] = $id;
			$messages = $validation->validate($_POST);
			foreach ($messages as $message) {
				throw new Exception($message,102);
		    }

		    //获取Post中的内容，然后将name存入到数据库中
			$name = $this->request->getPost('name');
			$unit = $this->request->getPost('unit');
			$type = $this->request->getPost('type');
			$user_group = $this->request->getPost('user_group');
			$item_id = $this->request->getPost('id');
		    $item = Item::findFirst($item_id);
		    if ($item == null) throw new Exception('item_id is not find', 1201);

			$item->name = $name;
			$item->unit = $unit;
			$item->type = $type;
			$item->user_group = $user_group;
			$success = $item->save();
			if ($success) {
				$ans['ret'] = 0;
			} else {
				foreach ($item->getMessages() as $message) {
					throw new Exception($message, 100);
				}
			}
		} catch(Exception $e) {
			$ans['ret'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}

	function findGroup($user_id)
	{
		$maps = UserMap::find('user_id='.$user_id);
		if (is_null($maps)) {
			return null;
		}
		$ans = [];
		$i = 0;
		foreach ($maps as $map) {
			$ans[$i] = $map->user_group_id; $i++;
		}
		return $ans;
	}

	public function getAction()
	{
		$ans = [];
		try {
			if (!$this->request->isGet()) {
				throw new Exception('请用正确的方式访问我们的API', 99);
			}
			$validation = new Phalcon\Validation();
			$validation->add('group_id',new Regex([
				'pattern' => '/[0-9]{0,10}/u',
				'message' => 'please give us a number.'
				]));
			$validation->add('user_id',new Regex([
				'pattern' => '/[0-9]{0,10}/u',
				'message' => 'please give us a number.'
				]));
			$messages = $validation->validate($_GET);
			foreach ($messages as $message) {
				throw new Exception($message,102);
		    }

		    $group_id = $this->request->getQuery('group_id');
		    $user_id  = $this->request->getQuery('user_id');
		    $group_ids = [];
		    if (is_null($group_id)) {
		    	$group_ids = $this->findGroup($user_id);
		    	if (is_null($group_ids) || count($group_ids)==0) throw new Exception('请提供必要的group_id或user_id', 1103);
		    } else {
		    	$group_ids = [];
		    	$group_ids[0] = $group_id;
		    }
		    $conditions = "user_group=".$group_ids[0];
		   	for ($i=1; $i < count($group_ids); $i++) { 
		   		$conditions .= (" or user_group=".$group_ids[$i]);
		   	}
		   	$items = Item::find($conditions);
		   	$data = [];
		   	$i = 0;
		   	foreach ($items as $item) {
		   		$p = [];
				$p['id']         = $item->id; 
				$p['name']       = $item->name; 
				$p['unit']       = $item->unit; 
				$p['type']       = $item->type; 
				$p['user_group'] = $item->user_group;
		   		$data[$i] = $p; $i++;
		   	}
		    $ans['data'] = $data;
		} catch(Exception $e) {
			$ans['data'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}	
	}



}

?>

