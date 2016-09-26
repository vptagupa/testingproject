<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class City extends Model {

	protected $table='city';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'name',
	);

	public $timestamps = false;
}