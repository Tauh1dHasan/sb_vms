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

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'user_type_id', 'first_name', 'last_name', 'slug', 'gender', 'dob', 'eid_no', 'dept_id', 'designation_id', 'mobile_no', 'email', 'address', 'photo', 'nid_no', 'driving_license_no', 'start_hour', 'end_hour', 'passport_no', 'entry_user_id', 'entry_datetime', 'modified_user_id', 'modified_datetime', 'availability', 'status'];

    /**
     * a single employee belongs to a single department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * a single employee belongs to a single designation
     */
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
