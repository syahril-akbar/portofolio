<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\FileUpload::make('photo')
                    ->label('Foto Profil (Opsional)')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('1:1')
                    ->directory('profiles')
                    ->avatar()
                    ->helperText('Unggah pas foto profesional untuk melengkapi CV kamu.')
                    ->visibility('public'),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->placeholder('Contoh: Budi Santoso')
                    ->required(),
                TextInput::make('headline')
                    ->label('Headline Profesi')
                    ->placeholder('Contoh: Full-stack Developer | UI/UX Enthusiast')
                    ->helperText('Tuliskan 1-2 kalimat singkat yang merangkum posisi/profesimu saat ini.'),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->placeholder('contoh@email.com')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Nomor Telepon/WhatsApp')
                    ->placeholder('Contoh: +6281234567890')
                    ->tel(),
                \Filament\Forms\Components\Textarea::make('address')
                    ->label('Alamat Domisili')
                    ->placeholder('Contoh: Jl. Sudirman No 1, Jakarta Selatan')
                    ->helperText('Alamat domisili saat ini.'),
                \Filament\Forms\Components\Textarea::make('about')
                    ->label('Tentang Saya (Summary)')
                    ->placeholder('Ceritakan singkat tentang dirimu, pengalaman inti, dan ambisi karirmu.')
                    ->helperText('Ringkasan profesional yang kuat sangat berguna untuk menarik perhatian HRD.')
                    ->columnSpanFull(),
                TextInput::make('linkedin_url')
                    ->label('Link Profil LinkedIn')
                    ->placeholder('https://linkedin.com/in/username')
                    ->url(),
                TextInput::make('github_url')
                    ->label('Link Profil GitHub/GitLab')
                    ->placeholder('https://github.com/username')
                    ->url(),
                TextInput::make('resume_url')
                    ->label('Tautan Eksternal Resume (Opsional)')
                    ->placeholder('https://drive.google.com/.../view')
                    ->url(),
                \Filament\Forms\Components\FileUpload::make('resume_file')
                    ->label('Upload File CV/Resume (PDF)')
                    ->directory('resumes')
                    ->acceptedFileTypes(['application/pdf'])
                    ->helperText('Upload file CV/Resume dalam bentuk format standar PDF maksimal 5MB.')
                    ->maxSize(5120)
                    ->columnSpanFull(),
            ]);
    }
}
