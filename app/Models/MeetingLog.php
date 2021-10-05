<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'meeting_logs';

    protected $primaryKey = 'log_id';
}
