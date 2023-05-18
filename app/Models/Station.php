<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'world_city_id', 'world_division_id'];

    protected $searchableFields = ['*'];

    public function allStaff()
    {
        return $this->hasMany(Staff::class);
    }
}
