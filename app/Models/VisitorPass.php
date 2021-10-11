<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorPass extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'visitor_pass';
    protected $primaryKey = 'visitor_pass_id';
}
