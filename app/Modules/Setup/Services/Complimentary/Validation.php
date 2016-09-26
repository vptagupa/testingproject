<?php
namespace App\Modules\Setup\Services\Complimentary;
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