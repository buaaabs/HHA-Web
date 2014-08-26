<?php
/* 
* @Author: sxf
* @Date:   2014-08-22 13:25:57
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-22 18:23:18
*/
use Phalcon\Validation,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Regex;

class FilterValidation extends Validation
{
	public function initialize()
	{
        $this->add('realname', new StringLength(array(
			'max' => 30,
			'messageMaximum' => 'Your name is too long, we can not save it',
        )));
        $this->add('email', new StringLength(array(
            'max' => 30,
			'messageMaximum' => 'The email is too long',
        )));
        $this->add('phone', new StringLength(array(
            'max' => 15,
			'messageMaximum' => 'The phone number is too long',
        )));
        $this->add('realname', new Regex(array(
		   'pattern' => '/[a-zA-Z0-9\x{4e00}-\x{9fa5}]+/u',
		   'message' => 'The creation date is invalid'
		)));
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
		$this->add('page', new PresenceOf([
			'message' => 'The page is needed'
		]));
		$this->add('limit', new PresenceOf([
			'message' => 'The limit is needed'
		]));
		$this->add('page', new StringLength([
			'max' => 10,
			'messageMaximum' => 'The page is too long'
		]));
		$this->add('limit', new StringLength([
			'max' => 10,
			'messageMaximum' => 'The limit is too long'
		]));
	}
}


?>
