<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class HotelServingStyle extends Model {

	protected $table='hotel_serving_style';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'name',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
	);

	public $timestamps = false;
}