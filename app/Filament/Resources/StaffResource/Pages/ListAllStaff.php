<?php

namespace App\Filament\Resources\StaffResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\StaffResource;
use App\Filament\Traits\HasDescendingOrder;

class ListAllStaff extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = StaffResource::class;
}
