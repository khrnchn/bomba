<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Counter extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['program_id', 'name', 'isCheckIn'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'isCheckIn' => 'boolean',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    public function allStaff()
    {
        return $this->belongsToMany(Staff::class);
    }
}
