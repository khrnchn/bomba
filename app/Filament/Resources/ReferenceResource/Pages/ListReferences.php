<?php

namespace App\Filament\Resources\ReferenceResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ReferenceResource;

class ListReferences extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ReferenceResource::class;
}
