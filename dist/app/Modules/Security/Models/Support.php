<?php

namespace App\Modules\Security\Models;

use illuminate\Database\Eloquent\Model;

class Support extends Model
{
    public $table = 'kt_support';
    protected $primaryKey = 'SuppotID';

    protected $fillable = [
    	'HeiID', 
    	'Subject',
    	'FullName',
    	'Email',
    	'FeedBack',
    	'IsClosed',
    	'Remarks',
    	'created_date',
    	'created_by',

    ];

    public $timestamps = false;
}
