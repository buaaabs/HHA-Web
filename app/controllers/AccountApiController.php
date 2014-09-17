<?php
/* 
* @Author: sxf
* @Date:   2014-08-18 14:11:18
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-17 18:32:51
*/

/**
 * @RoutePrefix("/AccountApi")
 */
class AccountApiController extends \Phalcon\Mvc\Controller
{
	public function initialize()
	{
		$this->view->disable(); //阻止显示
		$this->response->setHeader("Content-Type", "application/json; charset=utf-8");
	}


	/**
	 * @Get('/test')
	 */
	public function testAction()
	{
		$this->response->setHeader("Content-Type", "text/html; charset=utf-8");
	 	$this->view->enable();
	}

	//登陆方法，如果验证成功，会在Session中添加user_id一项

	public function loginAction()
	{

		if ($this->request->isPost()==true) {
			$ans = [];
			try {
				$validation = new AuthValidation();
				$messages   = $validation->validate($_POST);
				if (count($messages)) {
				    foreach ($messages as $message) {
				        throw new Exception($message,102);
				    }
				}

				$username = $this->request->getPost("username");
				$password = $this->request->getPost("password");

				$user = User::findFirst([
				    "username = :str:",
				    "bind" => ["str" => $username]
				]);

				if (!$user) {
					throw new Exception('用户名找不到',401);
				}

				// if ($this->security->checkHash($password,$user->password)) {
				if ($password == $user->password) {
					$ans['id'] = $user->id;

					if ($this->session->isStarted())
						$this->session->destroy();
					$this->session->start();
					$this->session->set('user',
					[
						'id'         => $user->id,
						'username'   => $user->username,
						'showname'   => $user->showname,
						'auth-group' => $user->auth_group
					]);
				} else {
					throw new Exception('密码不正确',402);
				}
			} catch (Exception $e) {
				$ans['id'] = -1;
				Utils::makeError($e, $ans);
			} finally {
				echo json_encode($ans);
			}

		}
	}

	public function logoutAction()
    {
        //Destroy the whole session
        $this->session->destroy();
    }

	public function signupAction()
	{
		// print_r($_POST);

		$ans = [];
		try {
			if ($this->request->isPost()==true) {
				$validation = new AuthValidation();
				$messages = $validation->validate($_POST);
				if (count($messages)) {
				    foreach ($messages as $message) {
				        throw new Exception($message,102);
				    }
				}
				
				$user = new User();
				 
				$password = $this->request->getPost("password");
				$user->username = 
					$this->request->getPost("username");
				$user->password = $password;
				// $user->password =  $this->security->hash($password);

				$user->showname = $user->username;

				$success = $user->save();
				if ($success) {
					$ans['id'] = $user->id;
				} else {
					foreach ($user->getMessages() as $message) {
						throw new Exception($message, 100);
					}
				}
			}
		} catch (Exception $e) {
			$ans['id'] = -1;
			Utils::makeError($e, $ans);
		} finally {
			echo json_encode($ans);
		}
		return 0;
	}

	public function extAction()
	{
		if ($this->request->isPost()) {
			$ans = [];
			try {
				//登陆验证
				$id = $this->checkLogin();

				$validation = new UserValidation();
				$messages = $validation->validate($_POST);
				if (count($messages)) {
				    foreach ($messages as $message) {
				        throw new Exception($message,102);
				    }
				}

				$user_ext = UserExt::findFirst($id);
				if ($user_ext == null)
				{
					$user_ext = new UserExt(); 
					$user_ext->id = $id;
				}
				$user_ext->realname = $_POST['realname'];
				$user_ext->phone    = $_POST['phone'];
				$user_ext->birthday = $_POST['birthday'];
				$user_ext->sex      = $_POST['sex'];
				$user_ext->email    = $_POST['email'];

				$date = explode('-',$user_ext->birthday);
				if (!checkdate($date[1], $date[2], $date[0])) {  //检查时间是否合法
					throw new Exception('日期不合法',602);
				}
				$z1 =strtotime (date("y-m-d")); //当前时间
				$z2 =strtotime ($user_ext->birthday);  //输入时间
				if ($z2 > $z1) {
					throw new Exception('这是未来的某一天',603);
				}

				$success = $user_ext->save();
				if ($success) {
					$ans['ret'] = 0;
				} else {
					foreach ($user_ext->getMessages() as $message) {
						throw new Exception($message, 100);
					}
				}
				echo json_encode($ans);

			} catch (Exception $e) {
				$ans['ret'] = -1;
				Utils::makeError($e, $ans);
				echo json_encode($ans);
			}		
		}
	}

	function checkLogin()
	{		
		//登陆验证

		//Check if the variable is defined
        if (!$this->session->has("user")) {
			throw new Exception('用户未登录', 103);
        }
		$user_id =$this->session->get('user')['id'];
		return $user_id;
	}

}


?>
