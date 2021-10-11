<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Included Models */
use App\Models\User;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\MeetingPurpose;

class Meeting extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'meetings';

    protected $primaryKey = 'meeting_id';

    protected $fillable = ['user_id', 'visitor_id', 'employee_id', 'meeting_purpose_id', 'purpose_describe', 'meeting_datetime', 'meeting_start_time', 'meeting_end_time', 'entry_user_id', 'entry_datetime', 'modified_user_id', 'modified_datetime', 'cancel_reason', 'meeting_status', 'checkin_status', 'has_vehicle'];

    /**
     * a single meeting belongs to one user_id
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * a single meeting belongs to one visitor
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id', 'visitor_id');
    }

    /**
     * a single meeting belongs to one employee
     */
    public function employee()
    {
        return $this->hasOne(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * a single meeting has one meeting purpose
     */
    public function meeting_purpose()
    {
        return $this->hasOne(MeetingPurpose::class, 'purpose_id', 'meeting_purpose_id');
    }
}
