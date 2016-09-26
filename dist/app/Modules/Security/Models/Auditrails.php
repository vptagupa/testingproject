<?php

namespace App\Modules\Security\Models;

use illuminate\Database\Eloquent\Model;

class Auditrails extends Model
{
    public $table = 'auditrails';
    protected $primaryKey = 'id';

    protected $fillable = [
    	'module', 
    	'controller',
    	'method',
    	'action',
    	'method_id',
    	'parameter',
    	'message',
    	'browser',
    	'ip_address',
    	'device',
    	'created_date',
    	'created_by',

    ];

    public $timestamps = false;
}
