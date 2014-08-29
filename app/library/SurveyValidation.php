<?php
/* 
* @Author: sxf
* @Date:   2014-08-29 15:44:41
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-29 15:46:09
*/
use Phalcon\Validation,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Regex;
/**
* 
*/
class SurveyValidation extends Validation
{
	public function initialize()
	{
		$this->add('item_id',new PresenceOf([
				'message'=>'item_id is needed']));
		$this->add('item_id',new Regex([
			'pattern'=>'/[0-9]{0,10}/u',
			'message'=>"item_id need a number"]));
		$this->add('value',new PresenceOf([
			'message'=>'value is needed']));
		$this->add('value',new StringLength([
			'max' => 200,
			'messageMaximum' => 'The value is too long, we can not save it.']));
	}
}

?>
