<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Check extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'program_id',
        'counter_id',
        'staff_id',
        'participant_id',
        'isCheckIn',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'isCheckIn' => 'boolean',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
