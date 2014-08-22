<?php
/* 
* @Author: sxf
* @Date:   2014-08-18 14:11:18
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-19 11:56:55
*/

class AuthApiController extends \Phalcon\Mvc\Controller
{
	public function initialize()
	{
		
	}

	public function loginAction()
	{
		if ($this->request->isPost()==true) {
			$ans = [];
            $validation=new AuthValidation();
			try {
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

				if ($user->password == $password) {
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
                $validation=new AuthUpdataValidation();
				$messages = $validation->validate($_POST);
				if (count($messages)) {
				    foreach ($messages as $message) {
				        throw new BaseException($message,102);
				    }
				}

				$user = new User();
				$user->username = 
					$this->request->getPost("username");
				$user->password = 
					$this->request->getPost("password");
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
			}
		}
	}

	public function extAction($id)
	{
		if ($this->request->isPut()) {
			$ans = [];
			try {
				
			} catch (BaseException $e) {
				
			}		
		}
	}

}


?>
