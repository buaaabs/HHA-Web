<?php
/* 
* @Author: sxf
* @Date:   2014-08-05 22:18:51
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-05 22:47:36
*/


class ControllerBase extends Phalcon\Mvc\Controller
{

    protected function initialize()
    {
        Phalcon\Tag::prependTitle('HHA | ');
    }

    // protected function forward($uri){
    // 	$uriParts = explode('/', $uri);
    // 	return $this->dispatcher->forward(
    // 		array(
    // 			'controller' => $uriParts[0], 
    // 			'action' => $uriParts[1]
    // 		)
    // 	);
    // }
}

?>