<?php

namespace App\Filament\Resources\Footers;

use App\Filament\Resources\Footers\Pages;
use App\Models\Footer;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
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
                Forms\Components\Section::make('Identitas & Lokasi')
                    ->description('Logo, alamat, dan peta lokasi yang ditampilkan di footer website.')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Logo Universitas')
                            ->image()
                            ->directory('footers')
                            ->visibility('public')
                            ->imagePreviewHeight('120')
                            ->maxSize(2048)
                            ->required()
                            ->helperText('Logo putih/transparan paling cocok untuk footer.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh: Jl. Pendidikan No. 1, Pematangsiantar, Sumatera Utara 21121')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('link_gmaps')
                            ->label('Link Google Maps (Embed URL)')
                            ->url()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('https://www.google.com/maps/embed?pb=...')
                            ->helperText('Buka Google Maps → cari lokasi → Share → Embed a map → copy URL src.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Kontak Resmi')
                    ->description('Email dan nomor WhatsApp yang bisa dihubungi pengunjung website.')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email Kontak')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->prefix('@')
                            ->placeholder('contoh: info@b-university.ac.id'),

                        Forms\Components\TextInput::make('wa')
                            ->label('Nomor WhatsApp')
                            ->required()
                            ->maxLength(255)
                            ->prefix('+62')
                            ->placeholder('contoh: 81234567890')
                            ->helperText('Tulis tanpa angka 0 di depan dan tanpa +62 (sudah di-prefix).'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Sosial Media')
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
                                    ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\DeleteBulkAction::make(),
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
        // Tombol "New Footer" hanya muncul jika belum ada record sama sekali
        return ! static::getModel()::query()->exists();
    }
}