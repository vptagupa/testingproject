<?php
namespace App\Modules\Setup\Services;

use App\Modules\Setup\Services\PriceType\Validation;

Class PriceTypeServiceProvider {

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
				'code' =>  getObjectValue($post,'code'),
				'name' =>  getObjectValue($post,'name'),
			];			
	}
}	
?>