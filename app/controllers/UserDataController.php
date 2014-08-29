<?php
/* 
* @Author: sxf
* @Date:   2014-08-26 15:21:12
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-29 16:29:30
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
		//登陆验证
		$id = $this->checkLogin();
		if ($id == null) return;
		// if ($id == null || ctype_digit($id)) throw new Exception('id有误', 1001);		
		$this->data_get_gAction($id);
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
			$ans['value'] = $item->value;
		} catch(Exception $e) {
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Put('/Data')
	 */
	public function data_putAction()
	{
		//登陆验证
		$id = $this->checkLogin();
		if ($id == null) return;
		// if ($id == null || ctype_digit($id)) throw new Exception('id有误', 1001);		
		$this->data_put_gAction($id);
	}


	/**
	 * @Put('/Data/{id:[0-9]+}')
	 */
	public function data_put_gAction($id)
	{
		$ans = [];
		try{
			$validation = new Phalcon\Validation();
			$validation->add('key',new PresenceOf([
				'message'=>'key is needed']));
			$validation->add('key',new StringLength([
				'max' => 200,
				'messageMaximum' => 'The key is too long, we can not save it.']]))
			$validation->add('value',new PresenceOf([
				'message'=>'value is needed']));
			$validation->add('value',new StringLength([
				'max' => 200,
				'messageMaximum' => 'The value is too long, we can not save it.']));

			$key   = $this->request->getPut('key');
			$value = $this->request->getPut('value');

			$item = $this->findData($id,$key);
			$item->value = $value;
			if ($item->save() == false) {
				throw new Exception('数据库异常', 100);
			}
			$ans['ret'] = 0;
			
		} catch(Exception $e) {
			Utils::makeError($e,$ans);
		} finally {
			echo json_encode($ans);
		}
	}
	
	/**
	 * @Get('/Survey')
	 */
	public function survey_get_Action()
	{
		$user_id = $this->checkLogin();
		if ($user_id == null) return;
		$this->survey_get_gAction($user_id);
	}

	/**
	 * @Get('/Survey/{id:[0-9]+}')
	 */
	public function survey_get_gAction($user_id)
	{
		$ans = [];
		try {
			$Get = $this->request->getGet(['item_id','datemin','datemax','limit']);

			$validation = new UserDataValidation();
			$messages   = $validation->validate($Get);
		    foreach ($messages as $message) {
		        throw new Exception($message,102);
		    }
		
			$conditions = 'item_id = :i_id: AND user_id = :u_id:';
			$parameters = [
				'i_id' => $Get['item_id'] ,
				'u_id' => $user_id
			];

			if (isset($datemin)) {
				$conditions .= 'AND date >= :min: ';
				$parameters['min'] = $Get['datemin'];
			} 
				
			if (isset($datamax)) {
				$conditions .= 'AND date <= :max: ';
				$parameters['max'] = $Get['datemax'];
			}
			
			$result  = Survey::find(
				$conditions,
				$parameters
			);
			$ans['data'] = [];
			$p = 0;
			foreach ($result as $item) {
				$ans['data'][$p] = [
					'value'=> $item->value,
					'date' => $item->date
				];
			
			}
		} catch (Exception $e) {
			Utils::makeError($ans,$e);
		} finally {
			echo json_encode($ans);
		}	
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
			$message = $validation->validate($_POST);
			if (count($messages)) {
			    foreach ($messages as $message) {
			        throw new Exception($message,102);
			    }
			}
			$item_id = $this->request->getPost('item_id');
			$value   = $this->request->getPost('value');

			$new_record = new Survey();
			$new_record->item_id = $item_id;
			$new_record->user_id = $id;
			$new_record->value   = $value;

			$succeed = $new_record->save();
			if ($succeed == false) throw new Exception('数据库异常',100);
			
			$ans['ret'] = 0;
		} catch (Exception $e) {
			$ans['ret'] = -1;
			Utils::makeError($ans,$e);
		} finally {
			echo json_encode($ans);
		}	
	}


	/**
	 * @Get('/Sample')
	 */
	public function sample_getAction()
	{
		$id = $this->checkLogin();
		if ($id == null) return;
		$this->sample_get_gAction($id);
	}

	/**
	 * @Get('/Sample/{id:[0-9]+}')
	 */
	public function sample_get_gAction($id)
	{
		$ans = [];
		try {
			$validation = new Phalcon\Validation();
			$validation->add('item_id',new PresenceOf([
				'message' => 'item_id is needed']));
			$validation->add('item_id',new Regex([
				'pattern' => '/[0-9]{0,10}/u',
				'message' => "item_id need a number"]));
			$message = $validation->validate($_POST);
			if (count($messages)) {
			    foreach ($messages as $message) {
			        throw new Exception($message,102);
			    }
			}
			$item_id = $this->request->getPost('item_id');
			$simple  = SurveySample::findFirst(
				'item_id=?0 AND id=?1',
				'bind' => [$id,$item_id]
			);
			if ($simple == null) throw new Exception('item can not find', 1002);
			$ans['value'] = $simple->value;

		} catch (Exception $e) {
			$ans['value'] = -1;
			Utils::makeError($ans,$e);
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
		$this->sample_post_gAction($id);
	}

	/**
	 * @Post('/Simple/{id:[0-9]+}')
	 */
	public function simple_post_gAction($id)
	{
		$ans = [];
		try {
			$validation = new SurveyValidation();
			$message = $validation->validate($_POST);
			if (count($messages)) {
			    foreach ($messages as $message) {
			        throw new Exception($message,102);
			    }
			}
			$item_id = $this->request->getPost('item_id');
			$value   = $this->request->getPost('value');

			$simple = new SurveySimple();
			$simple->item_id = $item_id;
			$simple->value   = $value;
			$succeed = $simple->save();
			if ($succeed == false) throw new Exception('数据库异常', 100);

			$ans['ret'] = 0;
		} catch (Exception $e) {
			$ans['ret'] = -1;
			Utils::makeError($ans,$e);
		} finally {
			echo json_encode($ans);
		}
	}

	function checkLogin()
	{		
		$ans = [];
		try {
			//登陆验证
			if (!isset($_SESSION['user'])) 
				throw new Exception('用户未登录', 103);
			$user_id = $_SESSION['user']['id'];
			return $user_id;
		} catch (Exception $e) {
			Utils::makeError($e,$ans);
			return null;
		} finally {
			echo json_encode($ans);
		}
	}

}




?>
