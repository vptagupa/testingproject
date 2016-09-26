<?php
namespace App\Modules\Setup\Services;

use App\Modules\Setup\Services\HotelDiscount\Validation;

Class HotelDiscountServiceProvider {

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
				'code'			=>  getObjectValue($post,'code'),
				'name'			=>  getObjectValue($post,'name'),
				'description'	=>  getObjectValue($post,'description'),
				'discount'		=>  getObjectValue($post,'discount'),
				'is_permanent' => getObjectValue($post,'isPermanent') ? 1 : 0,
				'effective_date'	=>  toSystemDateTime(getObjectValue($post,'EffectiveDate')),
				'in_effective_date'	=>  toSystemDateTime(getObjectValue($post,'InEffectiveDate')),
			];			
	}
}	
?> 