<?php
/* 
* @Author: sxf
* @Date:   2014-08-25 20:32:46
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-27 16:21:20
*/

use Phalcon\Events\Event,
        Phalcon\Mvc\User\Plugin,
        Phalcon\Mvc\Dispatcher,
        Phalcon\Acl;

/**
* Acl for user
*/
class Security extends Plugin
{
	public $acl = null;
	$isInitDone = false;

	public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
    	if (!$isInitDone) {
    		init("app/security/acl.data");
    		$isInitDone = true;
    	}

    	$user = $this->session->get('user');
    	$id = 1;
    	$role = '';
    	if (isset($user)) {
    		if (isset($user['auth-group-name'])) {
    			$role = $user['auth-group-name'];
    		} else {
    			$id = $user['auth-group'];
    			$auth_group = AuthGroup::findFirst($id);
    			$role = $auth_group->name;
    			$user['auth-group-name'] = $role;
    			$_SESSION['user'] = $user;
    		}
    	} 

    	$controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
    	$allowed = $acl->isAllowed($role, $controller, $action);
    	if ($allowed != Acl::ALLOW) {
    		$ans = [];
    		$ans['error'] = 104;
    		$ans['error-message'] = '权限不足';

    		echo json_encode($ans);
    		//Returning "false" we tell to the dispatcher to stop the current operation
            return false;
    	}
	}

	public function clearTemp()
	{
		
	}

	function adding()
	{
		//找到并添加所有角色，例如管理员，游客，用户等
		$auth_groups = AuthGroup::find();
		foreach ($auth_groups as $group) {
			$acl->addRole(new Phalcon\Acl\Role($group->name));
		}

		//添加访问控制资源
		$auth_names = AuthName::find();
		foreach ($auth_names as $auth_name) {
			$pname = explode('-',$auth_name->name);
			$acl->addResource($pname[0],$pname[1]);
		}

		//定义访问控制
		$maps = $AuthMap::find();
		foreach ($maps as $map) {
			$pname = explode('-',$map->auth_name);
			$acl->allow($map->auth_group,$pname[0],$pname[1]);
		}
	}

	function init($path)
	{
		//Check whether acl data already exist
		if (!is_file($path)) {

		    $acl = new \Phalcon\Acl\Adapter\Memory();
		    $acl->setDefaultAction(Phalcon\Acl::DENY);

		    //... Define roles, resources, access, etc
		    $this->adding();

		    // Store serialized list into plain file
		    file_put_contents($path, serialize($acl));

		} else {

		     //Restore acl object from serialized file
		     $acl = unserialize(file_get_contents($path));
		}
	}
}


?>
