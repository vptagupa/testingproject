<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class Complimentary extends Model {

	protected $table='hotel_complimentary';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'complimentary',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_deleted',
	);

	public $timestamps = false;
}