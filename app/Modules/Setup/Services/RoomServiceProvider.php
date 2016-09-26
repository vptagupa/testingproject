<?php
namespace App\Modules\Setup\Services;

use App\Modules\Setup\Services\Room\Validation;

Class RoomServiceProvider {

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
				'room_no' =>  getObjectValue($post,'RoomNo'),
				'room_name' =>  getObjectValue($post,'name'),
				'room_description' =>  getObjectValue($post,'description'),
				'room_type_id'	=>  decode(getObjectValue($post,'roomType')),
				'room_floor_id'	=>  decode(getObjectValue($post,'roomFloor')),
				'has_min_person' =>  getObjectValue($post,'HasMin') ? 1 : 0,
				'min_person' =>  getObjectValue($post,'MinPerson'),
				'max_person' =>  getObjectValue($post,'MaxPerson'),
				'per_person_amount' =>  decimal(getObjectValue($post,'PerAmount')),
				'has_max_pax' =>  getObjectValue($post,'HasPacks') ? 1 : 0,
			];			
	}
}	
?>