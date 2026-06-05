<?php

namespace App\Filament\Resources\Greetings\Pages;

use App\Filament\Resources\Greetings\GreetingResource;
use Filament\Resources\Pages\EditRecord;

class EditGreeting extends EditRecord
{
    protected static string $resource = GreetingResource::class;

    protected static ?string $title = 'Edit Sambutan';

    protected static ?string $navigationLabel = 'Edit Sambutan';
}
