<?php
namespace App\Modules\Setup\Services\HotelFloor;
use Validator;
Class Validation {
	
	public function validate($post)
	{
		$validator = validator::make(
			['name'		=>  getObjectValue($post,'name')],			
			['name'		=> 'required']
		);
		return $validator;
	}
}	
?>