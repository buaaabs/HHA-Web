<?php
/* 
* @Author: sxf
* @Date:   2014-09-02 16:55:42
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-02 16:58:38
*/

/**
* 
*/
class MyRegex extends \Phalcon\Validation\Validator\Regex
{
	
	function __construct()
	{
		parent::__construct([
		   'pattern' => '/[a-zA-Z0-9_\/\-\x{4e00}-\x{9fa5}]+/u',
		   'message' => 'The input is invalid'
		]);
	}
}

?>
