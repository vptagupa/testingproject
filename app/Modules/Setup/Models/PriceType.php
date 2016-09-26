<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class PriceType extends Model {

	protected $table='hotel_price_type';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'code',
			'name',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_inactive',
	);

	public $timestamps = false;
}