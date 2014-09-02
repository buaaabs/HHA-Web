<?php
/* 
* @Author: sxf
* @Date:   2014-08-22 13:25:57
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-01 13:11:28
*/
use Phalcon\Validation,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Regex,
    Phalcon\Validation\Validator\InclusionIn,
    Phalcon\Validation\Validator\Email;

class UserValidation extends Validation
{
	public function initialize()
	{
        $this->add('realname', new StringLength(array(
			'max' => 30,
			'min' => 2,
			'messageMaximum' => 'Your name is too long, we can not save it',
			'messageMinimum' => 'You have only one word for name, really?'
        )));
        $this->add('email', new StringLength(array(
            'max' => 30,
			'min' => 5,
			'messageMaximum' => 'The email is too long',
			'messageMinimum' => 'Please give us your real email.'
        )));
        $this->add('phone', new StringLength(array(
            'max' => 15,
			'min' => 5,
			'messageMaximum' => 'The phone number is too long',
			'messageMinimum' => 'Please give us your real phone number.'
        )));
        $this->add('realname', new Regex(array(
		   'pattern' => '/[a-zA-Z0-9\x{4e00}-\x{9fa5}]+/u',
		   'message' => 'The realname is invalid'
		)));
        $this->add('birthday', new StringLength([
			'max' => 10,
			'messageMaximum' => 'The birthday is too long'
		]));
		$this->add('birthday', new Regex([
			'pattern' => '/\d{4}-\d{2}-\d{2}/u',
			'message' => 'The birthday need a string like yyyy-mm-dd'
		]));
		$this->add('email', new Email([
   			'message' => 'The e-mail is not valid'
		]));
		$this->add('sex',new InclusionIn([
			'message' => 'The status must be true or false',
			'domain' => [1,0] //1 is boy,0 is girl
		]));
	}
}


?>
