<?php

namespace App\Modules\Security\Models\Users;

use illuminate\Database\Eloquent\Model;

class InviteLog extends Model
{
    public $table = 'kt_user_invites';
    protected $primaryKey = 'ID';

    protected $fillable = [
    	'UserID',
        'InvitedDate',
        'InvitedBy',
        'ActivatedDte',
        'Status'
    ];

    public $timestamps = false;
}
