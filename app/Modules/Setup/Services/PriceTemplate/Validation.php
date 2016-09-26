<?php
namespace App\Modules\Setup\Services\PriceTemplate;
use Validator;
Class Validation {
	
	public function validate($post)
	{
		$validator = validator::make(
			[
				'name'	=>  getObjectValue($post,'name'),
				'amount' =>  getObjectValue($post,'amount')
			],			
			[
				'name'	=> 'required',
				'amount' => 'required',
			]
		);
		return $validator;
	}
}	
?>