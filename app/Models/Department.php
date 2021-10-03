<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Included Models */
use App\Models\Employee;
use App\Models\Designation;

use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $primaryKey = 'dept_id';

    public $timestamps = false;

    protected $fillable = ['department_name', 'slug', 'entry_user_id', 'entry_datetime', 'modified_user_id', 'modified_datetime', 'status'];
}
