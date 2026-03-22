<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Proyek')
                    ->placeholder('Contoh: Aplikasi E-Commerce Berbasis Web')
                    ->helperText('Tuliskan judul atau nama proyek yang kamu kerjakan.')
                    ->required(),
                TextInput::make('slug')
                    ->label('URL Slug')
                    ->placeholder('contoh-aplikasi-e-commerce')
                    ->required(),
                TextInput::make('role')
                    ->label('Peran (Role)')
                    ->placeholder('Contoh: Full-stack Developer, UI/UX Designer')
                    ->helperText('Jelaskan peran spesifik kamu dalam pengerjaan proyek ini.'),
                \Filament\Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->displayFormat('m/Y')
                    ->helperText('Kapan proyek ini mulai dikerjakan.'),
                \Filament\Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->displayFormat('m/Y')
                    ->helperText('Kapan proyek ini selesai. Kosongkan jika masih berjalan.'),
                \Filament\Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi Proyek')
                    ->placeholder('Ceritakan detail proyek...')
                    ->helperText('Jelaskan secara ringkas tentang proyek, tantangan yang dihadapi, dan solusi yang kamu buat.')
                    ->required()
                    ->columnSpanFull(),
                \Filament\Forms\Components\TagsInput::make('tech_stack')
                    ->label('Teknologi (Tech Stack)')
                    ->placeholder('Tekan enter untuk menambah (cth: Laravel, React)')
                    ->helperText('Daftar bahasa pemrograman, framework, atau tools yang digunakan dalam proyek.')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar/Thumbnail Proyek')
                    ->image()
                    ->directory('projects_images')
                    ->helperText('Unggah screenshot atau thumbnail proyek (Format: jpg, png).'),
                TextInput::make('github_link')
                    ->label('Tautan Repositori (Kode/GitHub)')
                    ->placeholder('https://github.com/username/repo')
                    ->url(),
                TextInput::make('demo_link')
                    ->label('Tautan Demo Website/Aplikasi')
                    ->placeholder('https://demo-aplikasi.com')
                    ->url(),
                Toggle::make('is_published')
                    ->label('Publikasikan Proyek Ini?')
                    ->helperText('Jika diaktifkan, proyek ini akan tampil di portofolio publikmu.')
                    ->required(),
            ]);
    }
}
