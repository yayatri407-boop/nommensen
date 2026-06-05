<?php

namespace App\Filament\Resources\Histories;

use BackedEnum;
use App\Models\History;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    // ICON SIDEBAR
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // LABEL SIDEBAR
    protected static ?string $navigationLabel = 'Riwayat';
    protected static ?string $modelLabel = 'Riwayat';
    protected static ?string $pluralModelLabel = 'Riwayat';

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([

                \Filament\Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),

                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),

                \Filament\Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('histories')
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

                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),

                \Filament\Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),

                \Filament\Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
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
            'index' => \App\Filament\Resources\Histories\Pages\ListHistories::route('/'),
            'create' => \App\Filament\Resources\Histories\Pages\CreateHistory::route('/create'),
            'edit' => \App\Filament\Resources\Histories\Pages\EditHistory::route('/{record}/edit'),
        ];
    }
}