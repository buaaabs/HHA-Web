<?php
/* 
* @Author: sxf
* @Date:   2014-08-08 15:19:03
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-08 15:59:06
*/

class Resource
{

	public static function init($assets)
	{
		$assets
		    ->collection('css-main')
            ->addCss('css/main-style.css');

		//Javascripts in the footer
		$assets
		    ->collection('js-main')
		    ->addJs('js/jquery.js')
		    ->addJs('js/bootstrap.min.js');
	}

}


?>
