<?php

namespace App\Filament\Resources\Footers;

use App\Filament\Resources\Footers\Pages;
use App\Models\Footer;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Footer';
    protected static ?string $modelLabel = 'Footer';
    protected static ?string $pluralModelLabel = 'Pengaturan Footer';
    protected static UnitEnum|string|null $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Umum')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Logo Universitas')
                            ->image(),

                        Forms\Components\TextInput::make('alamat')
                            ->required(),

                        Forms\Components\TextInput::make('link_gmaps')
                            ->label('Link Google Maps')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),

                        Forms\Components\TextInput::make('wa')
                            ->label('WhatsApp')
                            ->required(),
                    ]),

                Section::make('Sosial Media')
                    ->description('Link akun resmi universitas di berbagai platform sosial media.')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Forms\Components\TextInput::make('link_instagram')
                            ->label('Instagram')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->prefix('🌐')
                            ->placeholder('https://instagram.com/buniversity'),

                        Forms\Components\TextInput::make('link_youtube')
                            ->label('YouTube')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->prefix('🌐')
                            ->placeholder('https://youtube.com/@buniversity'),

                        Forms\Components\TextInput::make('link_linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->prefix('🌐')
                            ->placeholder('https://linkedin.com/school/buniversity'),

                        Forms\Components\TextInput::make('link_facebook')
                            ->label('Facebook')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->prefix('🌐')
                            ->placeholder('https://facebook.com/buniversity'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Logo')
                    ->disk('public')
                    ->height(50),

                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50)
                    ->tooltip(fn (?string $state): ?string => $state)
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email disalin!')
                    ->icon('heroicon-o-envelope'),

                Tables\Columns\TextColumn::make('wa')
                    ->label('WhatsApp')
                    ->copyable()
                    ->copyMessage('Nomor WA disalin!')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->prefix('+62 '),

                Tables\Columns\TextColumn::make('link_instagram')
                    ->label('Instagram')
                    ->url(fn ($record) => $record->link_instagram, true)
                    ->icon('heroicon-o-link')
                    ->formatStateUsing(fn (?string $state): string => $state ? 'Buka' : '-')
                    ->color('info'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
                        ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFooters::route('/'),
            'create' => Pages\CreateFooter::route('/create'),
            'edit' => Pages\EditFooter::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return ! static::getModel()::query()->exists();
    }
}