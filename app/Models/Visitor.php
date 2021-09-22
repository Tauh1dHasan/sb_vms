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

    // public function setNameAttribute($value)
	// {
	// 	$this->attributes['first_name'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
	// }

    // public function setImageAttribute($value)
    // {
    //     $attribute_name = "profile_photo";
    //     if (request()->hasFile($attribute_name) && request()->file($attribute_name)->isValid()) {
    //         // self::deleteImage($value);
    //         $imagename = date('dmYhis').'.'.$value->getClientOriginalExtension();
    //         $value->move('backend/img/visitors', $imagename);
    //         $this->attributes['profile_photo'] = $imagename;
    //     }
    // }

    public function getRouteKeyName()
    {
    	return 'id';
    }
}
