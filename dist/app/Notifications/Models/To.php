<?php 
namespace App\Notifications\Models;

use illuminate\Database\Eloquent\Model;

Class To extends Model {

	public $table='kt_inbox_userto';
	protected $primaryKey ='ToID';

	protected $fillable  = array(
			'InboxID',
			'UserIDTo',
			'IsRead',
			'ReadDate'
	);

	public $timestamps = false;
}