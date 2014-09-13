<?php
/* 
* @Author: sxf
* @Date:   2014-08-18 16:40:00
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-03 17:09:23
*/

use Phalcon\Validation,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\Regex;

/**
* 
*/
class UserDataValidation extends Validation
{
	public function initialize()
	{
		$this->add('item_id', new PresenceOf(array(
            'message' => 'The item_id is required'
        )));
        $this->add('item_id', new Regex(array(
		   'pattern' => '/\d+/u',
		   'message' => 'The item_id is invalid'
		)));
        $this->add('datemin', new Regex(array(
		   'pattern' => '/(\d{4}-\d{2}-\d{2})?/u',
		   'message' => 'The min date is invalid'
		)));
        $this->add('datemax', new Regex(array(
		   'pattern' => '/(\d{4}-\d{2}-\d{2})?/u',
		   'message' => 'The max date is invalid'
		)));
	}
}






?>
