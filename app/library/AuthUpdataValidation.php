<?php
/* 
* @Author: sxf
* @Date:   2014-08-21 14:17:19
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-21 14:17:44
*/
use Phalcon\Validation,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\RegexValidator;
/**
* 
*/
class AuthUpdataValidation extends Validation
{
	public function initialize()
	{
		$this->add('realname', new StringLength([
			'max' => 30,
			'messageMaximum' => 'The realname is too long'
		]));
		$this->add('email', new StringLength([
			'max' => 30,
			'messageMaximum' => 'The email is too long'
		]));
		$this->add('phone', new StringLength([
			'max' => 15,
			'messageMaximum' => 'The phone number is too long'
		]));
		$this->add('birthday', new StringLength([
			'max' => 10,
			'messageMaximum' => 'The birthday is too long'
		]));
		$this->add('birthday', new RegexValidator([
			'pattern' => '/\d{4}-\d{2}-\d{2}/u',
			'message' => 'The birthday need a string like yyyy-mm-dd'
		]));
		$this->add('email', new EmailValidator([
   			'message' => 'The e-mail is not valid'
		]));
		$this->add('sex',new InclusionIn([
			'message' => 'The status must be true or false',
			'domain' => [1,0] //1 is boy,0 is girl
		]));

	}
}
?>
