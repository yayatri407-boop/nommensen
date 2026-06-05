<?php

namespace App\Filament\Resources\Greetings\Pages;

use App\Filament\Resources\Greetings\GreetingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGreeting extends CreateRecord
{
    protected static string $resource = GreetingResource::class;

    protected static ?string $title = 'Create Sambutan';

    protected static ?string $navigationLabel = 'Create Sambutan';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Debug: Log form data before processing
        \Log::info('Greeting form data before create: ' . json_encode($data));
        
        // Ensure cuplikan sambutan is not empty
        if (!isset($data['content']) || empty($data['content'])) {
            \Log::error('Cuplikan Sambutan field is empty or missing!');
            throw new \Exception('Cuplikan Sambutan field is required!');
        }
        
        // Ensure image is always a string
        if (isset($data['image']) && is_array($data['image'])) {
            $data['image'] = implode(',', $data['image']);
        }
        
        // Debug: Log final data before saving
        \Log::info('Greeting form data after processing: ' . json_encode($data));
        
        return $data;
    }
}
