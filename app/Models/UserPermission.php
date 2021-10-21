<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Included Models */
use App\Models\UserType;
use App\Models\Permission;

class UserPermission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'user_permissions';

    protected $primaryKey = 'user_permission_id';

    protected $fillable = ['user_type_id', 'permission_id', 'user_permission_status'];

    public function getRouteKeyName()
    {
        return 'user_permission_id';
    }

    /**
     * a single user permission row belongs to one role
     */
    public function user_types()
    {
        return $this->hasMany(UserType::class, 'user_type_id', 'user_type_id');
    }

    /**
     * a single user permission row belongs to one role
     */
    public function user_type()
    {
        return $this->hasOne(UserType::class, 'user_type_id', 'user_type_id');
    }

    /**
     * a single user permission has many permissions
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_id', 'permission_id');
    }
}
