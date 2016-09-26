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
				// 'username'		=> getObjectValue($post,'username'),
				'FullName'	=> getObjectValue($post,'FullName'),
				// 'gender'		=> getObjectValue($post,'gender'),
				'Email'			=> getObjectValue($post,'email'),
				// 'position_id'	=> getObjectValue($post,'position'),
				// 'department_id'	=> getObjectValue($post,'department'),
				// 'level_id'		=> getObjectValue($post,'level'),
				'group'		=> getObjectValue($post,'group'),
				// 'password'		=> getObjectValue($post,'upassword'),
				// 'password_confirmation'	=> getObjectValue($post,'cpassword'),

			],			
			[
				// 'username'		=> 'required|unique:kt_users',
				// 'password'		=> 'required|confirmed',
				// 'level_id'		=> 'required',
				'FullName'	=> 'required',		
				// 'gender'		=> 'required',
				'Email'			=> 'required|email',
				// 'position_id'	=> 'required',
				// 'department_id'	=> 'required',
				// 'level_id'		=> 'required',
				// 'password'		=> 'required',
			]
		);
		return $validator;
	}
}	
?>