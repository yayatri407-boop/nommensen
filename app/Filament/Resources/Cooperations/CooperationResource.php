<?php

namespace App\Filament\Resources\Cooperations;

use BackedEnum;
use App\Models\Cooperation;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class CooperationResource extends Resource
{
    protected static ?string $model = Cooperation::class;

    // ICON SIDEBAR
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // LABEL SIDEBAR
    protected static ?string $navigationLabel = 'Kerja Sama';
    protected static ?string $modelLabel = 'Kerja Sama';
    protected static ?string $pluralModelLabel = 'Kerja Sama';

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([

                \Filament\Forms\Components\FileUpload::make('image')
                    ->label('Logo / Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('cooperations')
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->maxSize(2048)
                    ->columnSpanFull(),

            ]);
    }

    // TABLE
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                \Filament\Tables\Columns\ImageColumn::make('image')
                    ->label('Logo')
                    ->disk('public')
                    ->height(60),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

            ])

            ->recordActions([
                \Filament\Actions\EditAction::make()->label('Edit'),
                \Filament\Actions\DeleteAction::make()->label('Delete'),
            ])

            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }

    // RELATIONS
    public static function getRelations(): array
    {
        return [];
    }

    // PAGES
    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Cooperations\Pages\ListCooperations::route('/'),
            'create' => \App\Filament\Resources\Cooperations\Pages\CreateCooperation::route('/create'),
            'edit' => \App\Filament\Resources\Cooperations\Pages\EditCooperation::route('/{record}/edit'),
        ];
    }
}