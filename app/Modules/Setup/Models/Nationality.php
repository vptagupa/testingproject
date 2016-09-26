<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class Nationality extends Model {

	protected $table='nationality';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'code',
			'name',
			'description',
			'is_default',
			'is_foreign',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_inactive',
	);

	public $timestamps = false;
}