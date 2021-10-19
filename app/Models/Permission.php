<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'permissions';

    protected $primaryKey = 'permission_id';

    protected $fillable = ['permission_title', 'permission_status'];

    public function getRouteKeyName()
    {
        return 'permission_id';
    }
}
