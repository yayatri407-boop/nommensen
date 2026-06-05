<?php

namespace App\Filament\Resources\Greetings\Pages;

use App\Filament\Resources\Greetings\GreetingResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ListGreetings extends ManageRecords
{
    protected static string $resource = GreetingResource::class;

    protected static ?string $title = 'Sambutan';

    protected static ?string $navigationLabel = 'Sambutan';

    protected static ?string $modelLabel = 'Sambutan';

    protected static ?string $pluralModelLabel = 'Sambutan';

    // TOMBOL TAMBAH DATA
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
