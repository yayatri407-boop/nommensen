<?php

namespace App\Filament\Resources\Histories\Pages;

use App\Filament\Resources\Histories\HistoryResource;
use Filament\Resources\Pages\ManageRecords;

class ListHistories extends ManageRecords
{
    protected static string $resource = HistoryResource::class;

    protected static ?string $title = 'Riwayat';

    protected static ?string $navigationLabel = 'Riwayat';

    protected static ?string $modelLabel = 'Riwayat';

    protected static ?string $pluralModelLabel = 'Riwayat';
}
