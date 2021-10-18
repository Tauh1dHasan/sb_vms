<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'reception_logs';

    protected $primaryKey = 'log_id';

    /**
     * a single receptionist log has one department
     */
    public function department()
    {
        return $this->hasOne(Department::class, 'dept_id', 'dept_id');
    }

    /**
     * a single receptionist log has one designation
     */
    public function designation()
    {
        return $this->hasOne(Designation::class, 'designation_id', 'designation_id');
    }

    /**
     * a single receptionist log belongs to one user account
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * a single receptionist log belongs to one employee account
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * a single receptionist log has one employee account
     */
    public function user_type()
    {
        return $this->hasOne(UserType::class, 'user_type_id', 'user_type_id');
    }
}
