<?php
/* 
* @Author: sxf
* @Date:   2014-08-26 15:21:12
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-27 13:51:19
*/


/**
* 这个控制器所属的接口负责用户进行数据上传与管理
*/
class UserDataController extends \Phalcon\Mvc\Controller
{
	public function initialize()
	{
		
	}

	public function dataAction($id=null)
	{
		$ans = [];
		$conditions = 'user_id = :id: AND key = :key:';
		$parameters = [
						'id'  => $id,
						'key' => $key
					];
		$bindtypes  = [
						'id'  => Column::BIND_PARAM_INT,
						'key' => Column::BIND_PARAM_STR
					];

		try{
			if ($this->request->isGet()) {
				if ($id==null) {
					//登陆验证
					if (!isset($_SESSION['user'])) 
						throw new Exception('用户未登录', 103);
					$id = $_SESSION['user']['id'];
					
				} else {
					//验证用户权限
				}
				if ($id == null || ctype_digit($id)) throw new Exception('id有误', 1001);

				//查询，并用bind限制SQL注入
				$key = $request->getQuery('key');
				$item = Data::findFirst(
					$conditions,
					'bind' => $parameters,
					'bindTypes' => $bindtypes
				);

				$ans['value'] = $item->value;

			} elseif ($this->request->isPut()) {
				$key   = $request->getPut('key');
				$value = $request->getPut('value');

				$item = Data::findFirst(
					$conditions,
					'bind' => $parameters,
					'bindTypes' => $bindtypes
				);
				$item->value = $value;
				if ($item->save() == false) {
					throw new Exception('数据库异常', 100);
				}
				$ans['ret'] = 0;
			}
		} catch(Exception $e) {
			Utils.makeError($ans,$e);
		} finally {
			echo json_encode($ans);
		}
		
	}


	public function surveyAction($id = null)
	{
		$ans = [];
		try {
			if ($request->isPut()) {
				$item_id = $request->getPut('item_id');
				$datemin = $request->getPut('datemin');
				$datemax = $request->getPut('datemax');

				
			}
		} catch (Exception $e) {
			Utils.makeError($ans,$e);
		} finally {
			echo json_encode($ans);
		}	
	}


	public function survey_filterAction($id = null)
	{
		
	}

	public function sampleAction($id = null)
	{
		
	}

}




?>
