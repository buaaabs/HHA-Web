<?php
/* 
* @Author: sxf
* @Date:   2014-08-08 13:17:35
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-28 18:25:50
*/

/**
* 
*/
class Utils
{
	public static function getIP()
	{
		if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) 
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; 
		else if (@$_SERVER["HTTP_CLIENT_IP"]) 
		$ip = $_SERVER["HTTP_CLIENT_IP"]; 
		else if (@$_SERVER["REMOTE_ADDR"]) 
		$ip = $_SERVER["REMOTE_ADDR"]; 
		else if (@getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
		else if (@getenv("HTTP_CLIENT_IP")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
		else if (@getenv("REMOTE_ADDR")) 
		$ip = getenv("REMOTE_ADDR"); 
		else 
		$ip = "Unknown"; 
		return $ip; 
	}

	public static function make()
	{

		$sessionvar = 'vdcode'; //Session变量名称 
		$width = 150; //图像宽度 
		$height = 20; //图像高度 


		$ans = mt_rand(0,9);
		$p1 = mt_rand(1,9);
		if ($p1 <= $ans)
		{
			$p2 = $ans - $p1;
			$operator = '+';
		} else {
			$p2 = $p1 - $ans;
			$operator = '-';
		}

		$code = array(); 
		$code[] = $p1; 
		$code[] = $operator; 
		$code[] = $p2; 
		$code[] = '=';
		$code[] = $ans;

		$_SESSION[$sessionvar] = $ans; 

		$img = ImageCreate($width,$height); 
		ImageColorAllocate($img, mt_rand(230,250), mt_rand(230,250), mt_rand(230,250)); 
		$color = ImageColorAllocate($img, 0, 0, 0); 

		$offset = 0; 
		foreach ($code as $char) { 
		$offset += 20; 
		$txtcolor = ImageColorAllocate($img, mt_rand(0,255), mt_rand(0,150), mt_rand(0,255)); 
		ImageChar($img, mt_rand(3,5), $offset, mt_rand(3,5), $char, $txtcolor); 
		} 

		for ($i=0; $i<100; $i++) { 
		$pxcolor = ImageColorAllocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255)); 
		ImageSetPixel($img, mt_rand(0,$width), mt_rand(0,$height), $pxcolor); 
		} 

		return ImagePng($img); 
	}

	public static function makeError($error, &$value)
	{
		$value['error'] = $error->getCode();
		$value['error-message'] = $error->getMessage();
		$value['error-file'] = $error->getFile();
		$value['error-Line'] = $error->getLine();
	}

}


?>
