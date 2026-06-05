<?php

namespace App\Filament\Resources\Facilities\Pages;

use App\Filament\Resources\Facilities\FacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ListFacilities extends ManageRecords
{
    protected static string $resource = FacilityResource::class;

    protected static ?string $title = 'Facilities';

    protected static ?string $navigationLabel = 'Facilities';

    protected static ?string $modelLabel = 'Facility';

    protected static ?string $pluralModelLabel = 'Facilities';

    // TOMBOL TAMBAH DATA
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}