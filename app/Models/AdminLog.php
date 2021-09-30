<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'admin_logs';

    protected $primaryKey = 'log_id';

    protected $fillable = ['visitor_type_id', 'visitor_type', 'visitor_type_status', 'entry_user_id', 'entry_datetime', 'status'];

    public function getRouteKeyName()
    {
        return 'log_id';
    }
}
