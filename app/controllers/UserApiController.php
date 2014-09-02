<?php
/* 
* @Author: sxf
* @Date:   2014-08-22 12:53:26
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-29 16:51:24
*/

/**
* @RoutePrefix("/UserApi")
*/
class UserApiController extends \Phalcon\Mvc\Controller
{
	$items = [
		{'id':'='},
		{'username':'like'},
		{'auth_group':'='}
	];

	$items_ext = [
		{'id':'='},
		{'realname':'like'},
		{'email':'like'},
		{'phone':'like'},
		{'sex':'='},
		{'birthday':'='}
	];

	public function initialize()
	{
		$this->view->disable(); //阻止显示
		$this->response->setHeader("Content-Type", "application/json; charset=utf-8");
	}

	/**
	* @Get("/User/{id:[0-9]{10}}",name="find-user")
	*/
	public function userAction($id=null)
	{
		$ans = [];
		try {
			// $watchbyself = true;
			if ($id==null) {
				if (isset($_SESSION['user'])) {
					$id = $_SESSION['user']['id'];
				} else {
					throw Exception('用户未登录',103);
				}
				// $watchbyself = false;
			} else {
				throw Exception('用户权限不足',104);
			}
			$User_ext = UserExt::findFirst([
			    "id = :id:",
			    "bind" => ['id' => $id]
			]);

			$date = explode('-', $User_ext->birthday); 
			$age  = date('Y') - $date[0];

			$ans['realname'] = $User_ext->realname;
			$ans['email']    = $User_ext->email;
			$ans['phone']    = $User_ext->phone;
			$ans['sex']      = $User_ext->sex;
			$ans['birthday'] = $User_ext->birthday;
			$ans['age']      = $age;
			echo json_encode($ans);

		} catch (\Exception $e) {
			Utils.makeError($e, $ans);
			echo json_encode($ans);
		}
	}


	/**
	* @Post("/User/filter}",name="user-filter")
	*/
	public function filterAction()
	{
		$ans = [];
		try {

			if (isset($_SESSION['user'])) {
				if ($_SESSION['user']['auth_group']) {
					throw Exception('用户权限不足',104);
				}
			} else {
				throw Exception('用户未登录',103);
			}

			$validation = new FilterValidation();
			$messages   = $validation->validate($_POST);
			if (count($messages)) {
			    foreach ($messages as $message) {
			        throw new Exception($message,102);
			    }
			}
			
			$conditions = "";
			$bp = true;
			foreach($items as $key => $value){
				if ($bp) {
					$bp = false;
					if ($key != '=')
						$conditions .= ("(".$key." like '".$_POST[$key]."%')");
					else
						$conditions .= ("(".$key." = '".$_POST[$key]."')");
				}
				$conditions .= ' AND ';
				if ($key != '=')
					$conditions .= ("(".$key." like '".$_POST[$key]."%')");
				else
					$conditions .= ("(".$key." = '".$_POST[$key]."')");
			}	
			$User = User::findFirst($conditions);
			// $_SESSION['User_f'] = $User;	
		
			$conditions = "";
			$bp = true;
			foreach($items_ext as $key){
				if ($bp) {
					$bp = false;
					if ($key != '=')
						$conditions .= ("(".$key." like '".$_POST[$key]."%')");
					else
						$conditions .= ("(".$key." = '".$_POST[$key]."')");
				}
				$conditions .= ' AND ';
				if ($key != '=')
					$conditions .= ("(".$key." like '".$_POST[$key]."%')");
				else
					$conditions .= ("(".$key." = '".$_POST[$key]."')");
			}

			$User_ext = UserExt::findFirst($conditions);
			// $_SESSION['User_ext'] = $User_ext;
			
			// Create a Model paginator
			$paginator = new \Phalcon\Paginator\Adapter\Model(
			    array(
			        "data" => $User_ext,
			        "limit"=> $_POST['limit'],
			        "page" => $_POST['page']
			    )
			);
			$page = $paginator->getPaginate();

			$ans['sum'] = $page->total_pages;
			$ans['data'] = [];
			foreach ($page->items as $item)
			{
				$ans['data']['id']       = $item->id;
				$ans['data']['username'] = $item->username;
				$ans['data']['realname'] = $item->realname;
				$ans['data']['email']    = $item->email;
				$ans['data']['phone']    = $item->phone;
				$ans['data']['sex']      = $item->sex;
				$ans['data']['birthday'] = $item->birthday;
				$ans['data']['age']      = $item->age;
			}
			echo json_encode($ans);

		} catch (Exception $e) {
			Utils.makeError($e, $ans);
			echo json_encode($ans);
		}
	}

	//用户批量修改功能
	/**
	* @Put("/User}",name="user-update")
	*/
	public function userAction() {
		$ans = [];
		try {
			if (isset($_SESSION['user'])) {
				if ($_SESSION['user']['auth_group']) {
					throw Exception('用户权限不足',104);
				}
			} else {
				throw Exception('用户未登录',103);
			}

			$q = $this->request;
			$_PUT = $q->getPut('data');

			foreach ($_PUT as $key => $value) {
				if (is_int($key)) {

					$user = User::findFirst('id=:id:',
						'bind' => ['id' => $key]);
					$user_ext = UserExt::findFirst('id=:id:'
						'bind' => ['id' => $key]);

					if (isset($value['username']))
						$user->username = $value['username'];
					if (isset($value['auth_group']))
						$user->auth_group = $value['auth_group'];
					if (isset($value['user_group']))
						$user->user_group = $value['user_group'];

					if (isset($value['realname']))
						$user_ext->realname = $value['realname'];
					if (isset($value['sex']))
						$user_ext->sex = $value['sex'];
					if (isset($value['birthday']))
						$user_ext->birthday = $value['birthday'];
					if (isset($value['email']))
						$user_ext->email = $value['email'];
					if (isset($value['phone']))
						$user_ext->phone = $value['phone'];

					if (!$user->save() || !$user_ext->save())
						throw new Exception('数据库异常',100);

				}
			}

			
			$ans['ret'] = 0;
			echo json_encode($ans);

		} catch (Exception $e) {
			$ans['ret'] = -1;
			Utils.makeError($e, $ans);
			echo json_encode($ans);
		}
	}


}



?>
