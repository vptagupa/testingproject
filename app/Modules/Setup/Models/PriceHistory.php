<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;
use DB;

Class PriceHistory extends Model {

	protected $table='hotel_price_history';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'template_id',
			'price',
			'created_by',
			'created_date',
	);

	public $timestamps = false;
}