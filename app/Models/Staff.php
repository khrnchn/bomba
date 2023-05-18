<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'station_id',
        'department_id',
        'referral_code',
    ];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    public function counters()
    {
        return $this->belongsToMany(Counter::class);
    }
}
