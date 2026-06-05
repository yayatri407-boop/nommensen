<?php

namespace App\Filament\Resources\Histories\Pages;

use App\Filament\Resources\Histories\HistoryResource;
use Filament\Resources\Pages\EditRecord;

class EditHistory extends EditRecord
{
    protected static string $resource = HistoryResource::class;

    protected static ?string $title = 'Edit Riwayat';

    protected static ?string $navigationLabel = 'Edit Riwayat';
}
