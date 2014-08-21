<?php
/* 
* @Author: sxf
* @Date:   2014-08-18 14:11:18
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-21 15:53:33
*/

class AuthApiController extends \Phalcon\Mvc\Controller
	{
	public function initialize()
	{
		$this->response->setHeader("Content-Type", "application/json; charset=utf-8");
	}

	public function loginAction()
	{
		if ($this->request->isPost()==true) {
			$ans = [];
			try {
				$validation = new AuthValidation();
				$messages = $validation->validate($_POST);
				if (count($messages)) {
				    foreach ($messages as $message) {
				        throw new BaseException($message,102);
				    }
				}

				$username = $this->request->getPost("username");
				$password = $this->request->getPost("password");

				$user = User::findFirst([
				    "username = :str:",
				    "bind" => ["str" => $username]
				]);
				if (is_null($user)) {
					throw new BaseException('用户名找不到',401);
				}

				if ($this->security->checkHash($password,$user->password)) {
					$ans['id'] = $user->id;
					echo json_encode($ans);
				} else {
					throw new BaseException('密码不正确',402);
				}
			} catch (BaseException $e) {
				$ans['id'] = -1;
				$e->putError($ans);
				echo json_encode($ans);
			} 

		}
	}

	public function signupAction()
	{
		if ($this->request->isPost()==true) {
			$ans = [];
			try {
				$validation = new AuthValidation();
				$messages = $validation->validate($_POST);
				if (count($messages)) {
				    foreach ($messages as $message) {
				        throw new BaseException($message,102);
				    }
				}

				$user = new User();
				$password = $this->request->getPost("password");
				$user->username = 
					$this->request->getPost("username");
				$user->password =
					$this->security->hash($password);
				$success = $user->save();

				if ($success) {
					$ans['id'] = $user->id;
					echo json_encode($ans);
				} else {
					foreach ($user->getMessages() as $message) {
						throw new BaseException($success, 100);
					}
				}
			} catch (BaseException $e) {
				$ans['id'] = -1;
				$e->putError($ans);
				echo json_encode($ans);
			} catch (Exception $ee) {
				$ans['id'] = -1;
				$ans['error'] = $ee->getCode();
				$ans['error-message'] = $ee->getMessage();
				$ans['error-file'] = $ee->getFile();
				$ans['error-Line'] = $ee->getLine();
				echo json_encode($ans);
			}
		}
	}

	public function extAction($id)
	{
		if ($this->request->isPut()) {
			$ans = [];
			try {
				//登陆验证

				$validation = new AuthUpdataValidation();
				$messages = $validation->validate($_PUT);
				if (count($messages)) {
				    foreach ($messages as $message) {
				        throw new BaseException($message,102);
				    }
				}

				$user_ext = new UserExt();
				$user_ext->realname = $this->request->getPut('realname');
				$user_ext->phone = $this->request->getPut('phone');
				$user_ext->birthday = $this->request->getPut('birthday');
				$user_ext->sex = $this->request->getPut('sex');
				$user_ext->email = $this->request->getPut('email');

				$date = explode('-',$user_ext->birthday);
				if (!checkdate($date[1], $date[2], $date[0])) {  //检查时间是否合法
					throw new BaseException('日期不合法',602);
				}
				$z1=strtotime (date("y-m-d")); //当前时间
				$z2=strtotime ($user_ext->birthday);  //输入时间
				if ($z2 >= $z1) {
					throw new BaseException('这是未来的某一天',603);
				}


			} catch (BaseException $e) {
				
			}		
		}
	}

}


?>
