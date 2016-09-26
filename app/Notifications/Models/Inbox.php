<?php 
namespace App\Notifications\Models;

use illuminate\Database\Eloquent\Model;

Class Inbox extends Model {

	public $table='kt_inbox';
	protected $primaryKey ='ID';

	protected $fillable  = array(
			'InboxTypeID',
			'UserIDFrom',
			'Icon',
			'Subject',
			'Content',
			'InboxDate',
			'InboxBy',
	);

	public $timestamps = false;
}