<?php

namespace App\Filament\Resources\CounterResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\CounterResource;

class ListCounters extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CounterResource::class;
}
