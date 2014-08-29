<?php
/* 
* @Author: sxf
* @Date:   2014-08-18 21:26:08
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-18 21:42:03
*/

/**
* 
*/
class BaseException extends Exception
{
	public function putError($value)
	{
		$value['error'] = $this->getCode();
		$value['error-message'] = $this->getMessage();
		$value['error-file'] = $this->getFile();
		$value['error-Line'] = $this->getLine();
	}
}


?>
