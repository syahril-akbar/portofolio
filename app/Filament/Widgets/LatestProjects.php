<?php

namespace App\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use App\Models\Project;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;

class LatestProjects extends TableWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Nama Proyek')
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Peran (Role)'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make()
                    ->url(fn (Project $record): string => \App\Filament\Resources\Projects\ProjectResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
