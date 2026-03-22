<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama pencapaian')
                    ->placeholder('Contoh: Juara 1 Lomba ASC Tingkat Nasional')
                    ->helperText('Tulis pencapaian yang paling mewakili usaha atau prestasi kamu.')
                    ->required(),
                TextInput::make('issuer')
                    ->label('Penerbit atau penyelenggara')
                    ->placeholder('Contoh: Kemnaker RI')
                    ->helperText('Sebutkan pihak yang menyelenggarakan atau menerbitkan pencapaian ini untuk memperjelas konteksnya.')
                    ->required(),
                DatePicker::make('date')
                    ->label('Tanggal pencapaian')
                    ->displayFormat('m/Y')
                    ->helperText('Waktu pencapaian membantu memberi gambaran kapan prestasi ini diraih.')
                    ->required(),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (opsional)')
                    ->placeholder('Tulis deskripsi pencapaian kamu')
                    ->helperText('Tambahkan penjelasan singkat tentang pencapaian kamu, seperti peran, skala, atau hasil yang diraih.')
                    ->columnSpanFull(),
                \Filament\Forms\Components\FileUpload::make('file')
                    ->label('Dokumen terkait pencapaian (opsional)')
                    ->placeholder('Klik untuk meng-upload file kesini')
                    ->directory('achievements_docs')
                    ->acceptedFileTypes(['application/pdf'])
                    ->helperText('Format pdf • ukuran maks 5MB')
                    ->maxSize(5120)
                    ->columnSpanFull(),
            ]);
    }
}
