<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Included Models */
use App\Models\User;
use App\Models\UserType;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;

class HostLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'host_logs';

    protected $primaryKey = 'log_id';

    /**
     * a single host log has one department
     */
    public function department()
    {
        return $this->hasOne(Department::class, 'dept_id', 'dept_id');
    }

    /**
     * a single host log has one designation
     */
    public function designation()
    {
        return $this->hasOne(Designation::class, 'designation_id', 'designation_id');
    }

    /**
     * a single host log belongs to one user account
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * a single host log belongs to one employee account
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * a single host log has one employee account
     */
    public function user_type()
    {
        return $this->hasOne(UserType::class, 'user_type_id', 'user_type_id');
    }
}
