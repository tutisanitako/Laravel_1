<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'code', 'credits'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
                    ->withPivot('enrollment_date', 'grade')
                    ->withTimestamps();
    }
}