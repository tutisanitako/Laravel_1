<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'birth_date'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get all enrollments for the student
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get all courses the student is enrolled in
     */
    public function courses()
{
    return $this->belongsToMany(Course::class, 'enrollments')
                ->withPivot('enrollment_date', 'grade')
                ->withTimestamps();
}
}