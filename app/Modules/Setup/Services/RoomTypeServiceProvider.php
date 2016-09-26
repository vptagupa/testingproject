<?php
namespace App\Modules\Setup\Services;

use App\Modules\Setup\Services\RoomType\Validation;

Class RoomTypeServiceProvider {

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
				'name' =>  getObjectValue($post,'name'),
				'bed_amount' => decimal(getObjectValue($post,'BedAmount')),
				'description' =>  getObjectValue($post,'description'),
				'color'	=>  getObjectValue($post,'color'),
				'icon'	=>  getObjectValue($post,'icon'),
			];			
	}
}	
?>