<?php
/* 
* @Author: sxf
* @Date:   2014-08-25 16:31:40
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-28 18:34:23
*/

/**
* 
*/
class AuthApiController extends \Phalcon\Mvc\Controller
{

	/**
	 * @Post('/AuthGroup')
	 */
	public function auth_groupAction()
	{
		$ans = [];
		try {
			$name = $this->request->getPost('name');
			$auth_group = new AuthGroup();
			$auth_group->name = $name;
			if ($auth_group->save() == false) {
				throw new Exception('数据库异常', 102);
			}
			$ans['ret'] = 0;
		} catch(Exception $e) {
			Utils::makeError($e, $ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Delete('/AuthGroup/{id:int}')
	 */
	public function del_authgroupAction($id)
	{
		$ans = [];
		try {
			$auth_group = AuthGroup::findFirst($id);
			if ($auth_group->delete() == false) {
				throw new Exception('数据库异常', 102);
			}
			$ans['ret'] = 0;
		} catch(Exception $e) {
			Utils.makeError($e, $ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Put('/AuthGroup/{id:int}')
	 */
	public function update_authgroupAction($id)
	{
		$ans = [];
		try {
			$auth_group = AuthGroup::findFirst($id);
			$auth_group->name = $this->request->getPut('name');
			if ($auth_group->save == false) {
				throw new Exception('数据库异常', 102);
			}
			$ans['ret'] = 0;
		} catch(Exception $e) {
			Utils.makeError($e, $ans);
		} finally {
			echo json_encode($ans);
		}
	}
}
?>
