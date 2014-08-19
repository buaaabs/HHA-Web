<?php
/* 
* @Author: sxf
* @Date:   2014-08-18 16:20:39
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-18 16:39:32
*/

/**
*  
*/
class Myfilter
{
	public function filter_md5($value)
	{
		return preg_replace('/[^0-9a-f]/', '', $value);
	}
	
}


?>
