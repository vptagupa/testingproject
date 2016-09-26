<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class Position extends Model {

	protected $table='user_position';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'code',
			'name',
			'description',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_inactive',
	);

	public $timestamps = false;
}