<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'status',
        'participant_as',
        'total_participants',
        'level',
    ];

    // Define relationships if necessary
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
