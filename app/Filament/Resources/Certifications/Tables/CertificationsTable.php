<?php

namespace App\Filament\Resources\Certifications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CertificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Program Sertifikasi')
                    ->searchable(),
                TextColumn::make('issuer')
                    ->label('Lembaga Penerbit')
                    ->searchable(),
                TextColumn::make('score')
                    ->label('Nilai/Skor')
                    ->searchable(),
                TextColumn::make('issued_at')
                    ->label('Tanggal Dikeluarkan')
                    ->date()
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->label('Tanggal Kedaluwarsa')
                    ->date()
                    ->sortable(),
                TextColumn::make('file')
                    ->label('Lampiran')
                    ->searchable(),
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
