<?php
namespace App\Modules\Setup\Services\Level;
use Validator;
Class Validation {
	
	public function validateSave($post)
	{
		$validator = validator::make(
			['code'		=>  getObjectValue($post,'code'),'name'	=> getObjectValue($post,'name')],			
			['name'		=> 'required','code'=>'required|unique:user_level']
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