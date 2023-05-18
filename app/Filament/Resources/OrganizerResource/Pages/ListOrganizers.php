<?php

namespace App\Filament\Resources\OrganizerResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\OrganizerResource;

class ListOrganizers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = OrganizerResource::class;
}
