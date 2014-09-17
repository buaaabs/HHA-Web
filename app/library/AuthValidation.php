<?php
/* 
* @Author: sxf
* @Date:   2014-08-18 16:40:00
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-17 13:13:53
*/

use Phalcon\Validation,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Regex;

/**
* 
*/
class AuthValidation extends Validation
{
	public function initialize()
	{
		$this->add('username', new PresenceOf(array(
            'message' => 'The username is required'
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
        $this->add('username', new Regex(array(
		   'pattern' => '/[a-zA-Z0-9_\-\x{4e00}-\x{9fa5}]{5,30}/u',
		   'message' => 'The creation date is invalid'
		)));
        $this->add('password', new Regex(array(
		   'pattern' => '/\S{5,30}/u',
		   'message' => 'The creation date is invalid'
		)));
	}
}



?>
