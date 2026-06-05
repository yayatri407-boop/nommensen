<?php

namespace App\Filament\Resources\Aboutmes\Pages;

use App\Filament\Resources\Aboutmes\AboutmeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ListAboutmes extends ManageRecords
{
    protected static string $resource = AboutmeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
