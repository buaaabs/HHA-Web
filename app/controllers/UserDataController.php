<?php
/* 
* @Author: sxf
* @Date:   2014-08-26 15:21:12
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-03 22:07:26
*/


use Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Regex;



//这个控制器所属的接口负责用户进行数据上传与管理

/** 
* @RoutePrefix("/UserData")
*/
class UserDataController extends \Phalcon\Mvc\Controller
{
	public function indexAction()
	{
		
	}

	public function initialize()
	{
		$this->view->disable(); //阻止显示
		$this->response->setHeader("Content-Type", "application/json; charset=utf-8");
	}

	/**
	 * @Get('/Pla/:int',paths={tit='hello',id=1})
	 */
	public function ttAction($id,$tit) //测试用
	{
		echo $id;
		echo $tit;
		echo $this->dispatcher->getParam('tit');
		echo ' ok,Data';
	}

	/**
	 * @Get('/Pl/:int/:int',paths={id=2,title=1})
	 */
	public function tttAction($id,$title)
	{
		echo $id;
		echo 'ok,Data';
	}

	function findData($id,$key)
	{
		$ans = [];
		$conditions = 'user_id = :id: AND key = :key:';
		$parameters = [
						'id'  => $id,
						'key' => $key
					];
		$bindtypes  = [
						'id'  => \Phalcon\Db\Column::BIND_PARAM_INT,
						'key' => \Phalcon\Db\Column::BIND_PARAM_STR
					];
		//查询，并用bind限制SQL注入
		
		$item = Data::findFirst([
			$conditions,
			'bind' => $parameters,
			'bindTypes' => $bindtypes
		]);

		return $item;
	}

	/**
	 * @Get('/Data')
	 */
	public function data_getAction()
	{
		$ans = [];
		try{
			$id = $this->checkLogin();
			$key   = $this->request->getQuery('key');
			$item  = $this->findData($id,$key);
			if ($item==null) throw new Exception('The key is not exist', 1001);
			$ans['key'] = $key;
			$ans['value'] = $item->value;
		} catch(Exception $e) {
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Get('/Data/:int',paths={id=1})
	 */
	public function data_get_gAction($id)
	{
		$ans = [];
		try{
			$key   = $this->request->getQuery('key');
			$item  = $this->findData($id,$key);
			if ($item==null) throw new Exception('The key is not exist', 1001);
			$ans['key'] = $key;
			$ans['value'] = $item->value;
		} catch(Exception $e) {
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Post('/Data')
	 */
	public function data_postAction()
	{
		$ans = ['hello'=>'yes'];
		try{
			//登陆验证
			$id = $this->checkLogin();
			$key   = $this->request->getPost('key');
			$value = $this->request->getPost('value');
			$ans['ret'] = $this->data_save($id,$key,$value);
		} catch(Exception $e) {
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}


	/**
	 * @Post('/Data/{id:[0-9]+}')
	 */
	public function data_post_gAction($id)
	{
		$ans = [];
		try{
			$user_id = $this->checkLogin();
			$key     = $this->request->getPost('key');
			$value   = $this->request->getPost('value');
			$ans['ret'] = $this->data_save($id,$key,$value);
		} catch(Exception $e) {
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
		return 0;
	}

	public function data_save($id,$key,$value)
	{
		$validation = new Phalcon\Validation();
		$validation->add('key',new PresenceOf([
			'message'=>'key is needed']));
		$validation->add('key',new StringLength([
			'max' => 200,
			'messageMaximum' => 'The key is too long, we can not save it.']));
		$validation->add('value',new PresenceOf([
			'message'=>'value is needed']));
		$validation->add('value',new StringLength([
			'max' => 200,
			'messageMaximum' => 'The value is too long, we can not save it.']));
		$messages   = $validation->validate(['key' => $key,'value' => $value]);
	    foreach ($messages as $message) {
	        throw new Exception($message,102);
	    }
		$data = $this->findData($id,$key);
		if ($data == null) {
			$data = new Data();
			$data->user_id = $id;
			$data->key     = $key;
		}
		$data->key   = $key;
		$data->value = $value;
		$data->date  = date("y-m-d H:i:s",time());
		$success     = $data->save();
		if ($success) {
			return 0;
		} else {
			foreach ($data->getMessages() as $message) {
				throw new Exception($message, 100);
			}
		}
	}
	
	/**
	 * @Get('/Survey')
	 */
	public function survey_get_Action()
	{
		$ans = [];
		try {
			$user_id = $this->checkLogin();
			//TODO:检查权限
			$ans = $this->survey_get($user_id);
		} catch (Exception $e) {
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Get('/Survey/{id:[0-9]+}')
	 */
	public function survey_get_gAction($user_id)
	{
		$ans = [];
		try {
			$user_id = $this->checkLogin();
			//TODO:检查权限
			$ans = $this->survey_get($user_id);
		} catch (Exception $e) {
			Utils::makeError($ans,$e);
		} finally {
			echo json_encode($ans);
		}	
	}

	public function survey_get($user_id)
	{
		$ans = [];
		// $Get = $this->request->getGet(['item_id','datemin','datemax','limit']);

		$validation = new UserDataValidation();
		$messages   = $validation->validate($_GET);
	    foreach ($messages as $message) {
	        throw new Exception($message,102);
	    }
	
		$conditions = 'item = :i_id: AND user_id = :u_id:';
		$parameters = [
			'i_id' => $_GET['item_id'] ,
			'u_id' => $user_id
		];

		if (isset($datemin)) {
			$conditions .= 'AND date >= :min: ';
			$parameters['min'] = $_GET['datemin'];
		} 
			
		if (isset($datamax)) {
			$conditions .= 'AND date <= :max: ';
			$parameters['max'] = $_GET['datemax'];
		}
		
		$result  = Survey::find([
			$conditions,
			'bind' => $parameters
		]);
		$ans['data'] = [];
		$p = 0;
		foreach ($result as $item) {
			$ans['data'][$p] = [
				'value'=> $item->value,
				'date' => $item->date
			];
			$p++;
		}
		// print_r($ans);
		return $ans;
	}

	/**
	 * @Post('/Survey')
	 */
	public function survey_post_Action()
	{
		$id = $this->checkLogin();
		if ($id == null) return;
		$this->survey_post_gAction($id);
	}

	/**
	 * @Post('/Survey/{id:[0-9]+}')
	 */
	public function survey_post_gAction($id)
	{
		$ans = [];
		try {
			$validation = new SurveyValidation();
			$messages = $validation->validate($_POST);
			if (count($messages)) {
			    foreach ($messages as $message) {
			        throw new Exception($message,102);
			    }
			}
			$item_id = $this->request->getPost('item_id');
			$value   = $this->request->getPost('value');

			$new_record = new Survey();
			$new_record->item    = $item_id;
			$new_record->user_id = $id;
			$new_record->value   = $value;
			$new_record->date    = date("y-m-d H:i:s",time());
			$succeed = $new_record->save();
			if ($succeed) {
				$ans['ret'] = 0;
			} else {
				foreach ($new_record->getMessages() as $message) {
					throw new Exception($message, 100);
				}
			}
			
		} catch (Exception $e) {
			$ans['ret'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}	
	}


	/**
	 * @Get('/Simple')
	 */
	public function simple_getAction()
	{
		$id = $this->checkLogin();
		if ($id == null) return;
		$this->simple_get_gAction($id);
	}

	/**
	 * @Get('/Simple/{id:[0-9]+}')
	 */
	public function simple_get_gAction($id)
	{
		$ans = [];
		try {
			$validation = new Phalcon\Validation();
			$validation->add('item_id',new PresenceOf([
				'message' => 'item_id is needed']));
			$validation->add('item_id',new Regex([
				'pattern' => '/[0-9]{0,10}/u',
				'message' => "item_id need a number"]));
			$messages = $validation->validate($_GET);
			if (count($messages)) {
			    foreach ($messages as $message) {
			        throw new Exception($message,102);
			    }
			}
			$item_id = $this->request->getQuery('item_id');
			$simple  = SurveySimple::findFirst([
				'item=?0 AND user_id=?1',
				'bind' => [$item_id,$id]
			]);
			if ($simple == null) throw new Exception('item can not find', 1002);
			$ans['value'] = $simple->value;

		} catch (Exception $e) {
			$ans['value'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Post('/Simple')
	 */
	public function simple_postAction()
	{
		$id = $this->checkLogin();
		if ($id == null) return;
		$this->simple_post_gAction($id);
	}

	/**
	 * @Post('/Simple/{id:[0-9]{1,10}}')
	 */
	public function simple_post_gAction($id)
	{
		$ans = [];
		try {
			$validation = new SurveyValidation();
			$messages = $validation->validate($_POST);
			if (count($messages)) {
			    foreach ($messages as $message) {
			        throw new Exception($message,102);
			    }
			}
			$item_id = $this->request->getPost('item_id');
			$value   = $this->request->getPost('value');

			$simple  = SurveySimple::findFirst([
				'item=?0 AND user_id=?1',
				'bind' => [$item_id,$id]
			]);
			if ($simple == null) {
				$simple = new SurveySimple();
				$simple->user_id = $id;
				$simple->item  = $item_id;
			}
			$simple->value = $value;
			$simple->date  = date("y-m-d H:i:s",time());
			$succeed = $simple->save();
			if ($succeed) {
				$ans['ret'] = 0;
			} else {
				foreach ($simple->getMessages() as $message) {
					throw new Exception($message, 100);
				}
			}
			$ans['ret'] = 0;
		} catch (Exception $e) {
			$ans['ret'] = -1;
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
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
