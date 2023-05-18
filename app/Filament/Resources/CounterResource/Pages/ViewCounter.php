<?php

namespace App\Filament\Resources\CounterResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CounterResource;

class ViewCounter extends ViewRecord
{
    protected static string $resource = CounterResource::class;
}
