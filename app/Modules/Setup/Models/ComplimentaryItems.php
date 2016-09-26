<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;
use DB;

Class ComplimentaryItems extends Model {

	protected $table='hotel_complimentary_details';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'link_id',
			'product_id',
			'price',
			'is_deleted',
	);

	public $timestamps = false;

	public static function data()
	{
		return
		DB::table('hotel_complimentary_details as t')
			->select([
				't.index_id',
				'p.name as product',
				't.price',
				'p.category_id',
				't.product_id'
			])
			->leftJoin('products as p',
					'p.index_id','=','t.product_id'
			)
			->where('t.is_deleted','0');
	}
}