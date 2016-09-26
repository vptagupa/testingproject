<?php
namespace App\Modules\Security\Services\Users;
use Validator;
use App\Config\Validation as AttachmentValidation;
use Request;

Class Repository {
	
	public function getPostSave()
	{
		return [
			'user_id' => Request::get('user_id'),
           	'password' => bcrypt(Request::get('password')),
           	'first_name' => Request::get('first_name'),
           	'middle_name' => Request::get('middle_name'),
           	'last_name' => Request::get('last_name'),
           	'gender' => Request::get('sex'),
           	'email' => Request::get('email'),
           	'mobile_no' => Request::get('mobile_no'),
           	'tel_no' => Request::get('tel_no'),
           	'position_id' => Request::get('position'),
           	'department_id' => Request::get('department'),
           	'level_id' => Request::get('level'),
           	'group_id' => Request::get('role'),
		];
	}

    public function getPostUpdate()
    {
        return [
            'first_name' => Request::get('first_name'),
            'middle_name' => Request::get('middle_name'),
            'last_name' => Request::get('last_name'),
            'gender' => Request::get('sex'),
            'email' => Request::get('email'),
            'mobile_no' => Request::get('mobile_no'),
            'tel_no' => Request::get('tel_no'),
            'position_id' => Request::get('position'),
            'department_id' => Request::get('department'),
            'level_id' => Request::get('level'),
            'group_id' => Request::get('role'),
        ];
    }

}	
?>