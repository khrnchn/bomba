<?php

namespace App\Filament\Resources\AnnouncementResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\AnnouncementResource;

class ListAnnouncements extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = AnnouncementResource::class;
}
