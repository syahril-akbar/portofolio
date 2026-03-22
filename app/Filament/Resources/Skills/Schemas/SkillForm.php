<?php

namespace App\Filament\Resources\Skills\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Keahlian')
                    ->placeholder('Contoh: Public Speaking, Laravel, Figma')
                    ->helperText('Ketik nama spesifik dari keahlianmu.')
                    ->required(),
                \Filament\Forms\Components\Select::make('category')
                    ->label('Kategori Keahlian')
                    ->options([
                        'Hard Skill' => 'Hard Skill',
                        'Soft Skill' => 'Soft Skill',
                        'Programming Language' => 'Bahasa Pemrograman',
                        'Tools/Software' => 'Tools & Software',
                        'Lainnya' => 'Kategori Lainnya',
                    ])
                    ->placeholder('Pilih kategori keahlian')
                    ->helperText('Klasifikasikan jenis keahlian yang kamu miliki.')
                    ->required(),
                \Filament\Forms\Components\Select::make('proficiency')
                    ->label('Tingkat Kemahiran')
                    ->options([
                        100 => 'Sangat Mahir (Expert)',
                        75  => 'Mahir (Advanced)',
                        50  => 'Menengah (Intermediate)',
                        25  => 'Pemula (Beginner)',
                    ])
                    ->placeholder('Pilih tingkat kemahiran')
                    ->helperText('Pilih tingkat penguasaan kamu terhadap keahlian ini.')
                    ->required(),
            ]);
    }
}
