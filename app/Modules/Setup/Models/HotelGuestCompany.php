<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class HotelGuestCompany extends Model {

	protected $table='hotel_guest_company';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'name',
			'address',
			'email',
			'mobile',
			'telephone',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_inactive',
	);

	public $timestamps = false;
}
