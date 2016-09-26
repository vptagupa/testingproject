<?php
namespace App\Modules\Setup\Services\HotelDiscount;
use Validator;
Class Validation {
	
	public function validate($post)
	{
		$validator = validator::make(
			$post,			
			['name'		=> 'required','discount' => 'required']
		);
		return $validator;
	}
}	
?>