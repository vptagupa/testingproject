<?php
namespace App\Modules\Setup\Services\Position;
use Validator;
Class Validation {
	
	public function validateSave($post)
	{
		$validator = validator::make(
			['code'		=>  getObjectValue($post,'code'),'name'	=> getObjectValue($post,'name')],			
			['name'		=> 'required','code'=>'required|unique:user_position']
		);
		return $validator;
	}

	public function validateUpdate($post)
	{
		$validator = validator::make(
			['name'	=> getObjectValue($post,'name'),'code'	=> getObjectValue($post,'code')],			
			['name'		=> 'required','code'=>'required']
		);
		return $validator;
	}
}	
?>