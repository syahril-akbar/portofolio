<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Nama Proyek')
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Peran (Role)')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Tgl Mulai')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('end_date')
                    ->label('Tgl Selesai')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('slug')
                    ->label('URL Slug')
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Gambar/Thumbnail'),
                TextColumn::make('github_link')
                    ->label('Tautan GitHub')
                    ->searchable(),
                TextColumn::make('demo_link')
                    ->label('Tautan Demo')
                    ->searchable(),
                IconColumn::make('is_published')
                    ->label('Publik?')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
