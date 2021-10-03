<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

/* Included Models */
use App\Models\Employee;
use App\Models\Department;

class Designation extends Model
{
    use HasFactory;

    protected $table = 'designations';

    protected $primaryKey = 'designation_id';

    public $timestamps = false;

    protected $fillable = ['designation', 'slug', 'dept_id', 'entry_user_id', 'entry_datetime', 'modified_user_id', 'modified_datetime', 'status'];

    /**
     * a single designation belongs to a single department
     */
    public function department()
    {
        return $this->hasOne(Department::class, 'dept_id', 'dept_id');
    }
}
