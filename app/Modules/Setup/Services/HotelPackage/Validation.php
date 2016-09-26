<?php
namespace App\Modules\Setup\Services\HotelPackage;
use Validator;
Class Validation {
	
	public function validate($post)
	{
		$validator = validator::make(
			$post,			
			[
				'name'		=> 'required',
				// 'category'		=> 'required',
				'price'		=> 'required',
			]
		);
		return $validator;
	}
}	
?>