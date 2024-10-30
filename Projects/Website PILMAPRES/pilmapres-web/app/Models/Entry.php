<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'participant_as',
        'total_participants',
        'level',
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(USER::class);
    }
}
