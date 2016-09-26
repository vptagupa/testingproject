<?php 
namespace App\Modules\Setup\Models;

use illuminate\Database\Eloquent\Model;
use DB;
Class HotelDiscount extends Model {

	protected $table='hotel_discount';
	protected $primaryKey ='index_id';

	protected $fillable  = array(
			'code',
			'name',
			'description',
			'discount',
			'is_permanent',
			'effective_date',
			'in_effective_date',
			'created_by',
			'created_date',
			'modified_by',
			'modified_date',
			'is_inactive',
	);

	public $timestamps = false;

	public function data()
	{
		$join = DB::table($this->table.' as t')
			->where('effective_date','>=',date('Y-m-d'))
			->where('in_effective_date','<=',date('Y-m-d'))
			->where('is_permanent','0');

		return
		DB::table($this->table.' as t')
			->where('is_permanent','1')
			->union($join);
	}
}