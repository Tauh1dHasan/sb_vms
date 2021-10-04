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
}
