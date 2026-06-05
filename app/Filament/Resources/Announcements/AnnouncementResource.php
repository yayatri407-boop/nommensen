<?php

namespace App\Filament\Resources\Announcements;

use BackedEnum;
use App\Models\Announcement;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    // ICON SIDEBAR
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // LABEL SIDEBAR
    protected static ?string $navigationLabel = 'Announcements';
    protected static ?string $modelLabel = 'Announcement';
    protected static ?string $pluralModelLabel = 'Announcements';

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([

                \Filament\Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),

                \Filament\Forms\Components\Textarea::make('content')
                    ->label('Konten')
                    ->required()
                    ->columnSpanFull(),

                \Filament\Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('announcements')
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

                \Filament\Tables\Columns\TextColumn::make('content')
                    ->label('Konten')
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
            'index' => \App\Filament\Resources\Announcements\Pages\ListAnnouncements::route('/'),
            'create' => \App\Filament\Resources\Announcements\Pages\CreateAnnouncement::route('/create'),
            'edit' => \App\Filament\Resources\Announcements\Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}