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

    public function setTitleAttribute($value)
	{
		$this->attributes['designation'] = $value;
        $this->attributes['slug'] = Str::slug($value);
	}

    /**
     * a single designation belongs to a single department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    /**
     * a single designation has many employees
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
