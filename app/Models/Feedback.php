<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'program_id',
        'participant_id',
        'comment',
        'rating',
        'feedback_photo_path',
    ];

    protected $table = 'feedbacks';

    protected $searchableFields = ['*'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
