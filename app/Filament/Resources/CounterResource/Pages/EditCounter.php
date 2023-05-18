<?php

namespace App\Filament\Resources\CounterResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CounterResource;

class EditCounter extends EditRecord
{
    protected static string $resource = CounterResource::class;
}
