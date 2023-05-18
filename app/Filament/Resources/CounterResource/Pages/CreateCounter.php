<?php

namespace App\Filament\Resources\CounterResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CounterResource;

class CreateCounter extends CreateRecord
{
    protected static string $resource = CounterResource::class;
}
