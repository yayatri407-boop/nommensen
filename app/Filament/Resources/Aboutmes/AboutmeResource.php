<?php

namespace App\Filament\Resources\Aboutmes;

use BackedEnum;
use App\Models\Aboutme;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class AboutmeResource extends Resource
{
    protected static ?string $model = Aboutme::class;

    // ICON SIDEBAR
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // LABEL SIDEBAR
    protected static ?string $navigationLabel = 'Aboutme';
    protected static ?string $modelLabel = 'Aboutme';
    protected static ?string $pluralModelLabel = 'Aboutme';

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([

                \Filament\Forms\Components\Textarea::make('content')
                    ->label('Konten')
                    ->required()
                    ->columnSpanFull(),

                \Filament\Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('aboutme')
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->maxSize(2048)
                    ->helperText('Upload gambar JPG/PNG maksimal 2MB.')
                    ->columnSpanFull(),

            ]);
    }

    // TABLE
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                \Filament\Tables\Columns\TextColumn::make('content')
                    ->label('Konten')
                    ->limit(50)
                    ->searchable()
                    ->wrap(),

                \Filament\Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->height(60),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
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
            'index' => \App\Filament\Resources\Aboutmes\Pages\ListAboutmes::route('/'),
            'create' => \App\Filament\Resources\Aboutmes\Pages\CreateAboutme::route('/create'),
            'edit' => \App\Filament\Resources\Aboutmes\Pages\EditAboutme::route('/{record}/edit'),
        ];
    }
}