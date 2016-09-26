<?php namespace App\Modules\Security\Models\Users;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = false;

    protected $table = 'users';

    protected $primaryKey ='id';

    /**
     * The attributes for actions model
     *
     * @var array
     */

    const DELETED_AT ='deleted_date';
    const UPDATED_AT ='modified_date';
    const CREATED_AT = 'created_date';

    /**
     * The attributes that should be dates
     *
     * @var array
     */
    protected $dates = ['deleted_date'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable  = array(   
           'user_id',
           'password',
           'remember_token',
           'first_name',
           'middle_name',
           'last_name',
           'gender',
           'address',
           'email',
           'mobile_no',
           'tel_no',
           'photo',
           'position_id',
           'department_id',
           'level_id',
           'group_id',
           'branch_id',
           'is_head',
           'user_id_head',
           'is_login',
           'last_login',
           'is_block',
           'created_by',
           'created_date',
           'modified_by',
           'modified_date',
           'deleted_date',
           'deleted_by'
        );
}
