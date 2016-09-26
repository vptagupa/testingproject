<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class HotelSpecialRequest extends Model {

	protected $table='hotel_special_request';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'request',
			'is_amount_value',
			'price',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_deleted',
	);

	public $timestamps = false;
}