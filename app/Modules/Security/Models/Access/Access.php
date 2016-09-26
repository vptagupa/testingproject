<?php

namespace App\Modules\Security\Models\Access;

use illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access';
    protected $primaryKey = 'index_id';

    protected $fillable = ['link_id', 'link_type','page_id','action_id'];

    public $timestamps = false;
}
