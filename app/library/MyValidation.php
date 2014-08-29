<?php
/* 
* @Author: sxf
* @Date:   2014-08-18 16:40:00
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-19 11:51:10
*/

use Phalcon\Validation,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\RegexValidator;

/**
* 
*/
class AuthValidation extends Validation
{
	public function initialize()
	{
		$this->add('username', new PresenceOf(array(
            'message' => 'The name is required'
        )));
        $this->add('password', new PresenceOf(array(
            'message' => 'The password is required'
        )));
        $this->add('username', new StringLength(array(
			'max' => 30,
			'min' => 3,
			'messageMaximum' => 'The username is too long',
			'messageMinimum' => 'We want more than just their initials'
        )));
        $this->add('password', new PresenceOf(array(
            'max' => 30,
			'min' => 5,
			'messageMaximum' => 'The password is too long',
			'messageMinimum' => 'We want more than just their initials'
        )));
        $this->add('username', new RegexValidator(array(
		   'pattern' => '/[a-zA-Z0-9_\-\x{4e00}-\x{9fa5}]+/u',
		   'message' => 'The creation date is invalid'
		)));
        $this->add('password', new RegexValidator(array(
		   'pattern' => '/\S+/u',
		   'message' => 'The creation date is invalid'
		)));
	}
}

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
			'domain' => [1,0]//1 is boy,0 is girl
		]));

	}
}




?>
