<?php 
namespace App\Notifications\Models;

use illuminate\Database\Eloquent\Model;

Class Conversation extends Model {

	public $table='kt_inbox_conversation';
	protected $primaryKey ='ConvoID';

	protected $fillable  = array(
			'InboxID',
			'UserID',
			'IsSender',
			'Content',
			'IsRead',
			'ReadDate',
			'Content',
			'Content',
			'CreatedBy',
	);

	public $timestamps = false;
}