<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'meetings';

    protected $primaryKey = 'meeting_id';

    protected $fillable = ['user_id', 'visitor_id', 'employee_id', 'meeting_purpose_id', 'purpose_describe', 'meeting_datetime', 'meeting_start_time', 'meeting_end_time', 'entry_user_id', 'entry_datetime', 'modified_user_id', 'modified_datetime', 'cancel_reason', 'meeting_status', 'checkin_status', 'has_vehicle'];

}
