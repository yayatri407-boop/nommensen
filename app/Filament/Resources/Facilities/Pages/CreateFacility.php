<?php

namespace App\Filament\Resources\Facilities\Pages;

use App\Filament\Resources\Facilities\FacilityResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\Request;

class CreateFacility extends CreateRecord
{
    protected static string $resource = FacilityResource::class;

    protected static ?string $title = 'Create Facility';

    protected static ?string $navigationLabel = 'Create Facility';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Debug: Log form data before processing
        \Log::info('Form data before create: ' . json_encode($data));
        
        // Ensure image is always a string
        if (isset($data['image']) && is_array($data['image'])) {
            $data['image'] = implode(',', $data['image']);
        }
        
        return $data;
    }
}
