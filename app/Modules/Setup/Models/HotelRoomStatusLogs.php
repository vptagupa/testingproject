<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;
use DB;

Class HotelRoomStatusLogs extends Model {

	public $table='hotel_room_status_logs';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'room_id',
			'status_id',
			'remarks',
			'created_by',
			'created_date'
	);

	public $timestamps = false;

	public function data()
	{	
		$status =new \App\Modules\Setup\Models\RoomStatus;
		return
		DB::table($this->table. ' as t')
			->leftJoin($status->table.' as s',
					's.index_id','=','t.status_id'
				)
			->leftJoin('hotel_room as r',
					'r.index_id','=','t.room_id'
				)
			->leftJoin(config('auth.table'). ' as u',
					'u.id','=','t.created_by'
				);
	}
}