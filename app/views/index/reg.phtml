<?php 
//------------------------------------- 
// 文件说明：数学运算验证码 
// 文件作者：Jesse Lee 
// 最后更新：2008-09-07 
//------------------------------------- 

session_start(); 

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

header('Content-type: image/png'); 
ImagePng($img); 
?> 