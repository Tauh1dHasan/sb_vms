<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'user_types';

    protected $primaryKey = 'user_type_id';

    protected $fillable = ['user_type_name', 'user_type_status', 'entry_user_id', 'entry_datetime', 'modified_user_id', 'modified_datetime'];

    public function getRouteKeyName()
    {
        return 'user_type_id';
    }
}
