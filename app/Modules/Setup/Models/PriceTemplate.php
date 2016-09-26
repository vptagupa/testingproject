<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;
use DB;

Class PriceTemplate extends Model {

	protected $table='hotel_price_template';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'room_type_id',
			'code',
			'name',
			'amount',
			'complimentary_id',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_inactive',
			'is_default',
			'is_custom',
			'value',
	);

	public $timestamps = false;

	public function RoomType()
	{
		return $this->hasMany('App\Modules\Setup\Models\RoomType','room_type_id');
	}

	public function data()
	{
		return
		DB::table($this->table.' as temp')
			->select([
				'temp.index_id',
				'temp.code',
				'temp.name',
				'temp.amount',
				'temp.is_inactive',
				'temp.is_default',
				'temp.room_type_id',
				'temp.is_custom',
				'temp.value',
				't.name as room_type',
				'c.complimentary',
			])
			->leftJoin('hotel_room_type as t','t.index_id','=','temp.room_type_id')
			->leftJoin('hotel_complimentary as c','c.index_id','=','temp.complimentary_id')
			->orderBy('t.index_id','asc');
			// ->where('temp.is_inactive','0')
			// ->where('t.is_inactive','0')
	}
}