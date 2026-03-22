<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Proyek', \App\Models\Project::count())
                ->description('Karya yang dipublikasikan')
                ->descriptionIcon('heroicon-m-folder-open')
                ->color('success'),
            Stat::make('Keahlian', \App\Models\Skill::count())
                ->description('Skill IT terdaftar')
                ->descriptionIcon('heroicon-m-code-bracket')
                ->color('info'),
            Stat::make('Sertifikasi', \App\Models\Certification::count())
                ->description('Lisensi & Pelatihan')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('warning'),
        ];
    }
}
