<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reference extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'code', 'value'];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'gender_id');
    }
}
