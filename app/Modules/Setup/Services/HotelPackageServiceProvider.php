<?php
namespace App\Modules\Setup\Services;

use App\Modules\Setup\Services\HotelPackage\Validation;
use Request;

Class HotelPackageServiceProvider {

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

	public function save($model,$items)
	{
		$key = 'index_id';

		if (!Request::get('key')) {
			$status = $model->create(
				assertCreated(
					$this->post(Request::all())
				)
			);
			hasRef($key,$status);
		} else {
			$status = $model
				->where('index_id',decode(Request::get('key')))
				->update(
					assertCreated(
						$this->post(Request::all())
					)
				);
			$key = decode(Request::get('key'));
		}

		if ($key) {
			// $this->saveItems($key,$items);
		}

		return true;
	}

	public function post($post)
	{
		return [
			'package' =>  getObjectValue($post,'name'),
			'category_id' =>  decode(getObjectValue($post,'category')),
			'price' =>  decimal(getObjectValue($post,'price')),
		];			
	}

	public function saveItems($key,$model)
	{
		$PK = 'id';
		foreach($this->items($key) as $row) {
			if (getObjectValue($row,'index_id')) {
				$model->where('index_id',getObjectValue($row,'index_id'))
						->update($this->postItems($row));
			} else {
				$model->create($this->postItems($row));
			}
		}
	}

	public function postItems($post)
	{
		return [
				'index_id' => getObjectValue($post,'index_id'),
	 			'link_id' => getObjectValue($post,'link_id'),
	 			'product_id' => getObjectValue($post,'product_id'),
	 			'price' => decimal(getObjectValue($post,'price')),
	 			'quantity' => decimal(getObjectValue($post,'quantity'))
			];			
	}

	public function items($key) {
	 	$data = json_decode('['.Request::get('data').']',true);
	 	$data = isset($data[0]) ? $data[0] : [];
	 	$datas = [];

	 	foreach($data as $row) {
	 		$row = getRawData($row);
	 		$datas[] = [
	 			'index_id' => decode(getObjectValue($row,'id')),
	 			'link_id' => $key,
	 			'product_id' => getObjectValue($row,'product'),
	 			'price' => decimal(getObjectValue($row,'price')),
	 			'quantity' => decimal(getObjectValue($row,'quantity'))
	 		];
	 	}
	 	return $datas;
	}
}	
?>