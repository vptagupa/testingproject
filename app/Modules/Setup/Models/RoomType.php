<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class RoomType extends Model {

	protected $table='hotel_room_type';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'name',
			'description',
			'bed_amount',
			'color',
			'icon',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_inactive',
	);

	public $timestamps = false;
}