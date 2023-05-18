<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManualPayment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['file_path', 'remarks', 'payment_method'];

    protected $searchableFields = ['*'];

    protected $table = 'manual_payments';

    public function transaction()
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }
}
