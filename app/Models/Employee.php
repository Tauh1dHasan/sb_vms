<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

/* Included Models */
use App\Models\Department;
use App\Models\Designation;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'employees';

    protected $primaryKey = 'employee_id';

    protected $fillable = ['user_id', 'user_type_id', 'first_name', 'last_name', 'slug', 'gender', 'dob', 'eid_no', 'dept_id', 'designation_id', 'mobile_no', 'email', 'address', 'photo', 'nid_no', 'driving_license_no', 'start_hour', 'end_hour', 'passport_no', 'entry_user_id', 'entry_datetime', 'modified_user_id', 'modified_datetime', 'availability', 'status'];

    /**
     * a single employee has one department
     */
    public function department()
    {
        return $this->hasOne(Department::class, 'dept_id', 'dept_id');
    }

    /**
     * a single employee has one designation
     */
    public function designation()
    {
        return $this->hasOne(Designation::class, 'designation_id', 'designation_id');
    }

    /**
     * a single employee has one user account
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'user_id');
    }

    protected $rules = [
        'email' => 'required|email|unique:users',
    ];
}
