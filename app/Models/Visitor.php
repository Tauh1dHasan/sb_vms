<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Visitor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'visitor_id';

    protected $fillable = ['user_id', 'visitor_type', 'first_name', 'last_name', 'slug', 'mobile_no', 'email', 'address', 'nid_no', 'driving_license_no', 'passport_no', 'dob', 'gender', 'profile_photo', 'entry_user_id', 'modified_user_id', 'visitor_status'];

    public function getRouteKeyName()
    {
    	return 'id';
    }
}
