<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;
use DB;

Class HotelRoomStatus extends Model {

	public $table='hotel_room_status';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'room_id',
			'status_id',
	);

	public $timestamps = false;

	public function available()
	{
		return
		DB::table('hotel_room as r')
			->select([
				DB::raw("'Vacant' as status"),DB::raw("'1' as status_id"),
				'r.index_id as room_id',
				'r.room_no','rt.name as type',
				'rt.index_id as type_id','rt.color'
			])
			->leftJoin('hotel_room_type as rt','rt.index_id','=','r.room_type_id')
			->whereRaw("r.index_id not in (select room_id from hotel_room_status)");
	}


	public function status()
	{
		return
		DB::table($this->table.' as t')
			->select([
				's.status','t.status_id','t.room_id',
				'r.room_no','rt.name as type',
				'rt.index_id as type_id','rt.color'
			])
			->leftJoin('room_status as s','s.index_id','=','t.status_id')
			->leftJoin('hotel_room as r','r.index_id','=','t.room_id')
			->leftJoin('hotel_room_type as rt','rt.index_id','=','r.room_type_id');
	}

	public function data()
	{
		$data = DB::table($this->table.' as t')
			->select([
				's.status','t.status_id','t.room_id',
				'r.room_no','rt.name as type',
				'rt.index_id as type_id','rt.color'
			])
			->leftJoin('room_status as s','s.index_id','=','t.status_id')
			->leftJoin('hotel_room as r','r.index_id','=','t.room_id')
			->leftJoin('hotel_room_type as rt','rt.index_id','=','r.room_type_id');

		return
		DB::table('hotel_room as r')
			->select([
				DB::raw("'Vacant' as status"),DB::raw("'1' as status_id"),
				'r.index_id as room_id',
				'r.room_no','rt.name as type',
				'rt.index_id as type_id','rt.color'
			])
			->leftJoin('hotel_room_type as rt','rt.index_id','=','r.room_type_id')
			->whereRaw("r.index_id not in (select room_id from hotel_room_status)")
			->union($data);
	}

	public function FDOnly()
	{
		$data = DB::table($this->table.' as t')
			->select([
				's.status','t.status_id','t.room_id',
				'r.room_no','rt.name as type',
				'rt.index_id as type_id','rt.color'
			])
			->leftJoin('room_status as s','s.index_id','=','t.status_id')
			->leftJoin('hotel_room as r','r.index_id','=','t.room_id')
			->leftJoin('hotel_room_type as rt','rt.index_id','=','r.room_type_id')
			->where('rt.index_id','<>',getFxID());

		return
		DB::table('hotel_room as r')
			->select([
				DB::raw("'Vacant' as status"),DB::raw("'1' as status_id"),
				'r.index_id as room_id',
				'r.room_no','rt.name as type',
				'rt.index_id as type_id','rt.color'
			])
			->leftJoin('hotel_room_type as rt','rt.index_id','=','r.room_type_id')
			->whereRaw("r.index_id not in (select room_id from hotel_room_status)")
			->where('rt.index_id','<>',getFxID())
			->union($data);
	}

	public function FXOnly()
	{
		$data = DB::table($this->table.' as t')
			->select([
				's.status','t.status_id','t.room_id',
				'r.room_no','rt.name as type',
				'rt.index_id as type_id','rt.color'
			])
			->leftJoin('room_status as s','s.index_id','=','t.status_id')
			->leftJoin('hotel_room as r','r.index_id','=','t.room_id')
			->leftJoin('hotel_room_type as rt','rt.index_id','=','r.room_type_id')
			->where('rt.index_id',getFxID());

		return
		DB::table('hotel_room as r')
			->select([
				DB::raw("'Vacant' as status"),DB::raw("'1' as status_id"),
				'r.index_id as room_id',
				'r.room_no','rt.name as type',
				'rt.index_id as type_id','rt.color'
			])
			->leftJoin('hotel_room_type as rt','rt.index_id','=','r.room_type_id')
			->whereRaw("r.index_id not in (select room_id from hotel_room_status)")
			->where('rt.index_id',getFxID())
			->union($data);
	}

	public function dataExUnion($data, $type = '')
	{
		$data = $this->dataEx($type)->union($data);
		return !$type ? $data : $data->where('rt.index_id',$type);
	}
}
