<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;
use DB;

Class HotelPackage extends Model {

	protected $table='hotel_package';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'package',
			'category_id',
			'price',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_deleted',
	);

	public $timestamps = false;

	public static function data()
	{
		return
			DB::table('hotel_package as t')
				->select([
					't.*',
					'cat.name as category'
				])
				->leftJoin('category as cat','cat.index_id','=','t.category_id');
	}
}