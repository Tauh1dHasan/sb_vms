<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class VisitorType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'visitor_types';

    protected $primaryKey = 'visitor_type_id';

    protected $fillable = ['visitor_type', 'slug', 'visitor_type_status', 'entry_user_id', 'entry_datetime', 'modified_user_id', 'modified_datetime'];

    public function getRouteKeyName()
    {
        return 'visitor_type_id';
    }

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['visitor_type'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
    // }
}
