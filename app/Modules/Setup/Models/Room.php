<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;
use DB;

Class Room extends Model {

	protected $table='hotel_room';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'room_no',
			'room_name',
			'room_description',
			'room_type_id',
			'room_floor_id',
			'has_min_person',
			'min_person',
			'max_person',
			'per_person_amount',
			'has_max_pax',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_inactive',
	);

	public $timestamps = false;

	public static function getAll()
	{
		return
		DB::table('hotel_room as room')->select([
			'room.index_id as room_id',
			'room.is_inactive as is_room_inactive',
			'room_no',
			'room_name',
			'room_description',
			'room_type_id',
			'room_floor_id',
			'type.name as type',
			'floor.name as floor',
			'has_min_person',
			'min_person',
			'max_person',
			'per_person_amount',
			'has_max_pax'
		])
		->leftJoin('hotel_room_type as type','type.index_id','=','room.room_type_id')
		->leftJoin('hotel_floor as floor','floor.index_id','=','room.room_floor_id')
		->get();
	}
}