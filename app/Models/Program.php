<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'registration_start_date',
        'registration_end_date',
        'capacity',
        'poster_path',
        'address',
        'world_division_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_start_date' => 'datetime',
        'registration_end_date' => 'datetime',
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    // ada error
    // public function feedbacks()
    // {
    //     return $this->hasMany(Feedback::class);
    // }

    public function counters()
    {
        return $this->hasMany(Counter::class);
    }

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }
}
