<?php
namespace App\Modules\Security\Services\Users;
use Validator;
use App\Config\Validation as AttachmentValidation;

Class Validation {
	public function save($post)
	{
		$validator = validator::make(
			[
				'user_id'		=> getObjectValue($post,'user_id'),
				'first_name'	=> getObjectValue($post,'first_name'),
				'last_name'		=> getObjectValue($post,'last_name'),
				'gender'		=> getObjectValue($post,'gender'),
				'email'			=> getObjectValue($post,'email'),
				'role'			=> getObjectValue($post,'role'),
				'sex'			=> getObjectValue($post,'sex'),
				'password'		=> getObjectValue($post,'password'),
				'password_confirmation'	=> getObjectValue($post,'cpassword'),
			],			
			[
				'user_id'		=> 'required|unique:users',
				'password'		=> 'required|confirmed',
				'first_name'	=> 'required',
				'last_name'		=> 'required',
				'sex'		=> 'required',
				'role'			=> 'required',
				'email'			=> 'required|email|unique:users',
			]
		);
		return $validator;
	}

	public function update($post)
	{
		$validator = validator::make(
			[
				'first_name'	=> getObjectValue($post,'first_name'),
				'last_name'		=> getObjectValue($post,'last_name'),
				'gender'		=> getObjectValue($post,'gender'),
				'role'			=> getObjectValue($post,'role'),
				'sex'			=> getObjectValue($post,'sex'),
			],			
			[
				'first_name'	=> 'required',
				'last_name'		=> 'required',
				'sex'		=> 'required',
				'role'			=> 'required',
			]
		);
		return $validator;
	}
}	
?>