<?php
// app/Models/Result.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_name',
        'father_name',
        'mother_name',
        'program',
        'study_center',
        'batch',
        'passing_year',
        'gpa_cgpa',
        'selected_semesters',
        'semester_results',
        'status'
    ];

    protected $casts = [
        'selected_semesters' => 'array',
        'semester_results' => 'array',
        'passing_year' => 'integer',
        'gpa_cgpa' => 'float'
    ];

    // Scope for active results
    public function scopeActive($query)
    {
        return $query->where('status', 'on');
    }

    // Accessor for formatted semesters
    public function getFormattedSemestersAttribute()
    {
        return implode(', ', $this->selected_semesters ?? []);
    }
}