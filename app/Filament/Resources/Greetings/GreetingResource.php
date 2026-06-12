<?php

namespace App\Filament\Resources\Greetings;

use BackedEnum;
use App\Models\Greeting;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;

class GreetingResource extends Resource
{
    protected static ?string $model = Greeting::class;

    // ICON SIDEBAR
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // LABEL SIDEBAR
    protected static ?string $navigationLabel = 'Sambutan';
    protected static ?string $modelLabel = 'Sambutan';
    protected static ?string $pluralModelLabel = 'Sambutan';

    // FORM
    public static function form(Schema $schema): Schema
    {
        return $schema->schema([

            \Filament\Forms\Components\Textarea::make('content')
                ->label('Cuplikan Sambutan')
                ->placeholder('Masukkan cuplikan sambutan...')
                ->required()
                ->rows(3)
                ->columnSpanFull(),

            \Filament\Forms\Components\FileUpload::make('image')
                ->label('Gambar')
                ->image()
                ->disk('public')
                ->directory('greetings')
                ->visibility('public')
                ->moveFiles()
                ->imagePreviewHeight('150')
                ->maxSize(2048)
                ->required()
                ->columnSpanFull(),

        ]);
    }

    // TABLE
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                \Filament\Tables\Columns\TextColumn::make('content')
                    ->label('Cuplikan Sambutan')
                    ->limit(100)
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

            ->filters([
                //
            ])

            ->defaultSort('created_at', 'desc');
    }

    // PAGES
    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\Greetings\Pages\ListGreetings::route('/'),
            'create' => \App\Filament\Resources\Greetings\Pages\CreateGreeting::route('/create'),
            'edit' => \App\Filament\Resources\Greetings\Pages\EditGreeting::route('/{record}/edit'),
        ];
    }
}