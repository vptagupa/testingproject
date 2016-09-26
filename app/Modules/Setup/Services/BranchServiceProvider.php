<?php
namespace App\Modules\Setup\Services;

use App\Modules\Setup\Services\Branch\Validation;

Class BranchServiceProvider {

	public function __construct()
	{
		$this->validation = new Validation;
	}

	public function isValid($post,$action = 'save')
	{	
		if ($action == 'save') {
			$validate = $this->validation->validate($post);
			if ($validate->fails())
			{
				return ['error'=>true,'message'=>getErrorMessages($validate->errors()->getMessages())];
			}
		} 
		
		return ['error'=>false,'message'=> ''];
	}

	public function post($post)
	{
		return [
				'name'			=>  getObjectValue($post,'name'),
				'description'	=>  getObjectValue($post,'description'),
			];			
	}
}	
?>