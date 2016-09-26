<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;

Class Province extends Model {

	protected $table='province';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'name',
	);

	public $timestamps = false;
}