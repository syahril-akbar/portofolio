<?php

namespace App\Filament\Resources\Certifications\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CertificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Program sertifikasi')
                    ->placeholder('Ketik program sertifikasi')
                    ->helperText('Pilih atau tuliskan nama program sertifikasi yang kamu ikuti.')
                    ->required(),
                TextInput::make('issuer')
                    ->label('Lembaga sertifikasi')
                    ->placeholder('Pilih lembaga sertifikasi')
                    ->helperText('Sebutkan lembaga yang menerbitkan sertifikasi ini untuk memperjelas kredibilitasnya.')
                    ->required(),
                TextInput::make('score')
                    ->label('Nilai')
                    ->placeholder('Tambahkan , apabila desimal')
                    ->helperText('Masukkan nilai atau skor yang kamu peroleh dari sertifikasi ini, jika tersedia.')
                    ->numeric(),
                DatePicker::make('issued_at')
                    ->label('Tanggal dikeluarkan')
                    ->displayFormat('m/Y')
                    ->helperText('Tanggal ini menunjukkan kapan sertifikasi resmi diterbitkan.')
                    ->required(),
                DatePicker::make('expires_at')
                    ->label('Tanggal berakhir')
                    ->displayFormat('m/Y')
                    ->helperText('Isi jika sertifikasi memiliki masa berlaku.'),
                \Filament\Forms\Components\FileUpload::make('file')
                    ->label('Dokumen sertifikasi')
                    ->placeholder('Klik untuk meng-upload file kesini')
                    ->directory('certifications')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->helperText('Format jpg, jpeg, png, pdf • ukuran maks 5MB')
                    ->maxSize(5120)
                    ->columnSpanFull(),
            ]);
    }
}
