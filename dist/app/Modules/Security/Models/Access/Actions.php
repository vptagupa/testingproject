<?php

namespace App\Modules\Security\Models\Access;

use illuminate\Database\Eloquent\Model;

class Actions extends Model
{
    protected $table = 'page_actions';
    protected $primaryKey = 'action_id';

    protected $fillable = ['page_id', 'name','slug','is_default','sort'];

    public $timestamps = false;
}
