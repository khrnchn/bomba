<?php

namespace App\Filament\Resources\ParticipantResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ParticipantResource;

class ListParticipants extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ParticipantResource::class;
}
