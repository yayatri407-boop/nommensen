<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->default()
            ->login()
            ->resources([
                \App\Filament\Resources\Aboutmes\AboutmeResource::class,
                \App\Filament\Resources\Announcements\AnnouncementResource::class,
                \App\Filament\Resources\Admins\AdminResource::class,
                \App\Filament\Resources\News\NewsResource::class,
                \App\Filament\Resources\Rektors\RektorResource::class,
                \App\Filament\Resources\Students\StudentResource::class,
                \App\Filament\Resources\Visimisis\VisimisiResource::class,
                \App\Filament\Resources\Cooperations\CooperationResource::class,
                \App\Filament\Resources\Facilities\FacilityResource::class,
                \App\Filament\Resources\Footers\FooterResource::class,
                \App\Filament\Resources\Greetings\GreetingResource::class,
                \App\Filament\Resources\Histories\HistoryResource::class,
                \App\Filament\Resources\Lectures\LectureResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Add widgets here
            ]);
    }
}