<?php namespace App\Models\Setup\config;
use illuminate\Database\Eloquent\Model;

Class GeneratedNumber extends Model {

	protected $table='config_numbers';
	protected $primaryKey ='index_id';

	protected $fillable  = [ 'format','start_at',''];

	public $timestamps = false;

	public function getSettings($type)
	{
		return $this->where('type',$type)->get();
	}
}