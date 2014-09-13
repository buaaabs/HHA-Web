<?php
/* 
* @Author: sxf
* @Date:   2014-09-01 14:24:07
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-03 16:05:16
*/
use Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Regex;

/** 
* @RoutePrefix("/UserGroup")
*/
class UserGroupController extends \Phalcon\Mvc\Controller
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
				'max' => 30,
				'messageMaximum' => 'The name is too long.'
				]));
			$messages = $validation->validate($_POST);
			foreach ($messages as $message) {
				throw new Exception($message,102);
		    }

		    //获取Post中的内容，然后将name存入到数据库中
			$name = $this->request->getPost('name');
			$userGroup = new UserGroup();
			$userGroup->name = $name;
			$success = $userGroup->save();
			if ($success) {
				$ans['id'] = $userGroup->id;
			} else {
				foreach ($userGroup->getMessages() as $message) {
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
		    $userGroup = UserGroup::findFirst($id);
		    if ($userGroup == null) throw new Exception('id is not find', 1201);
		    $succeed = $userGroup->delete();
		    if ($succeed) {
		    	$ans['ret'] = 0;
		    } else {
		    	foreach ($userGroup->getMessages() as $message) {
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

	public function updateAction()
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
			$validation->add('name',new PresenceOf([
				'message'=>'name is needed']));
			$validation->add('name',new StringLength([
				'max' => 30,
				'messageMaximum' => 'The name is too long.'
				]));
			$messages = $validation->validate($_POST);
			foreach ($messages as $message) {
				throw new Exception($message,102);
		    }

			$id   = $this->request->getPost('id');
			$name = $this->request->getPost('name');
		    $userGroup = UserGroup::findFirst($id);
		    if ($userGroup == null) throw new Exception('id is not find', 1201);
			$userGroup->id   = $id;
			$userGroup->name = $name;
			$succeed = $userGroup->save();

			if ($succeed) {
		    	$ans['ret'] = 0;
		    } else {
		    	foreach ($userGroup->getMessages() as $message) {
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

	
	//查看所有组的信息列表
	public function getAction()
	{
		$ans = [];
		try {
			if (!$this->request->isGet()){
				throw new Exception('请用正确的方式访问我们的API', 99);
			}
			$groups = UserGroup::find();
			$arr = [];
			$i = 0;
			foreach ($groups as $group) {
				$arr[$i]['id'] = $group->id;
				$arr[$i]['name'] = $group->name;
				$i++;
			}
			$ans['data'] = $arr;
		} catch(Exception $e) {
			$ans['data'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}    
	}

	//根据Group_id查组名
	/**
	 * @Get('/Get/{id:[0-9]{1,10}}')
	 */
	public function get_gAction($id)
	{
		$ans = [];
		try {
			$group = UserGroup::findFirst($id);
			if ($group == null) throw new Exception('group id is not find', 1202);
			$ans['name'] = $group->name;
		} catch(Exception $e) {
			$ans['name'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}

	//给某一个用户添加一个组别
	/**
	 * @Post('/AddGroup/{user_id:[0-9]{1,10}}')
	 */
	public function addGroupAction($user_id)
	{
		$ans = [];
		try {
			$group_id = $this->request->getPost('group_id');
			echo $group_id;
			if (!is_numeric($group_id)) throw new Exception('please give us a number', 1301);
			
			$map = new UserMap();
			$map->user_id = $user_id;
			$map->user_group_id = $group_id;
			$succeed = $map->save();
			if ($succeed) {
		    	$ans['ret'] = 0;
		    } else {
		    	foreach ($map->getMessages() as $message) {
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

	//删除用户的组别
	/**
	 * @Post('/DeleteGroup/{user_id:[0-9]{1,10}}')
	 */
	public function deleteGroupAction($user_id)
	{
		$ans = [];
		try {
			$group_id = $this->request->getPost('group_id');
			if (!is_int($group_id)) throw new Exception('please give us a number', 1301);
			
			$map = UserMap::findFirst('user_id='.$user_id.' and user_group_id='.$group_id);
			$succeed = $map->delete();
			if ($succeed) {
		    	$ans['ret'] = 0;
		    } else {
		    	foreach ($map->getMessages() as $message) {
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

}


?>
