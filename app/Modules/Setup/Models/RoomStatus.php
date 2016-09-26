<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class RoomStatus extends Model {

	public $table='room_status';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'status'
	);

	public $timestamps = false;
}