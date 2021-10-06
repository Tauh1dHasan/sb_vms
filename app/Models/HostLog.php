<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'host_logs';

    protected $primaryKey = 'log_id';
}
