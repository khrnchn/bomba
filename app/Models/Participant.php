<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'isMalaysian',
        'user_id',
        'world_country_id',
        'world_division_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'isMalaysian' => 'boolean',
    ];

    public function getIsMalaysianNameAttribute()
    {
        if ($this->isMalaysian) {
            return 'Yes';
        }

        return 'No';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }
}
