<?php
namespace App\Modules\Setup\Services;

use App\Modules\Setup\Services\PriceTemplate\Validation;

Class PriceTemplateServiceProvider {

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
				'value' =>  getObjectValue($post,'value'),
				'complimentary_id' => decode(getObjectValue($post,'complimentary')),
				'room_type_id' =>  decode(getObjectValue($post,'RoomType')),
				'amount' =>  decimal(getObjectValue($post,'amount')),
				'is_default' =>  getObjectValue($post,'IsDefault') ? 1 : 0,
				'is_custom' =>  getObjectValue($post,'IsCustom') ? 1 : 0,
			];			
	}

	public function getHistory($data)
	{
		return [
			'template_id' => getObjectValue($data,'index_id'),
			'price' => getObjectValue($data,'amount'),
			'created_by' => getObjectValue($data,'created_by'),
			'created_date' => getObjectValue($data,'created_date'),
		];
	}

	public function isUpdatedPrice($model,$key,$price)
	{
		$count = $model->where([
			'index_id'=>$key,
			'amount' => decimal($price)
		])->limit(1)->count();
		return $count > 0 ? false : true;
	}
}	
?>