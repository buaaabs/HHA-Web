<?php
/* 
* @Author: sxf
* @Date:   2014-08-25 16:31:40
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-04 00:22:27
*/

/**
* @RoutePrefix("/AuthGroup")
*/
class AuthGroupController extends \Phalcon\Mvc\Controller
{

	public function initialize()
	{
		$this->view->disable(); //阻止显示
		$this->response->setHeader("Content-Type", "application/json; charset=utf-8");
	}

	/**
	 * @Post('/Add')
	 */
	public function addAction()
	{
		$ans = [];
		try {
			if (!$this->request->isPost()) {
				throw new Exception("Please use the post method", 99);
			}
			$name = $this->request->getPost('name');
			$auth_group = new AuthGroup();
			$auth_group->name = $name;
			if ($auth_group->save() == false) {
				throw new Exception('数据库异常', 102);
			}
			$ans['id'] = $auth_group->id;
		} catch(Exception $e) {
			$ans['id'] = -1;
			Utils::makeError($e, $ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Post('/AuthGroup/Delete')
	 */
	public function deleteAction()
	{
		$ans = [];
		try {
			if (!$this->request->isPost()) {
				throw new Exception("Please use the post method", 99);
			}
			$id = $this->request->getPost('id');
			$auth_group = AuthGroup::findFirst($id);
			if ($auth_group->delete() == false) {
				throw new Exception('数据库异常', 102);
			}
			$ans['ret'] = 0;
		} catch(Exception $e) {
			$ans['ret'] = -1;
			Utils::makeError($e, $ans);
		} finally {
			echo json_encode($ans);
		}
	}

	/**
	 * @Post('/Update/:int',path={id=1})
	 */
	public function updateAction($id)
	{
		$ans = [];
		try {
			if (!$this->request->isPost()) {
				throw new Exception("Please use the post method", 99);
			}
			$auth_group = AuthGroup::findFirst($id);
			$auth_group->name = $this->request->getPost('name');
			if ($auth_group->save == false) {
				throw new Exception('数据库异常', 102);
			}
			$ans['ret'] = 0;
		} catch(Exception $e) {
			$ans['ret'] = -1;
			Utils::makeError($e, $ans);
		} finally {
			echo json_encode($ans);
		}
	}
}
?>
