<?php

namespace App\Filament\Resources\Trainings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TrainingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('organizer')
                    ->label('Lembaga Pelatihan')
                    ->placeholder('Pilih lembaga pelatihan (atau ketik nama)')
                    ->helperText('Pilih lembaga yang menyelenggarakan pelatihan yang kamu ikuti.')
                    ->required(),
                TextInput::make('name')
                    ->label('Program Pelatihan')
                    ->placeholder('Pilih program pelatihan')
                    ->helperText('Pilih atau tuliskan nama program pelatihan sesuai sertifikat yang kamu miliki.')
                    ->required(),
                TextInput::make('vocational_field')
                    ->label('Kejuruan')
                    ->placeholder('Pilih kejuruan')
                    ->helperText('Pilih bidang keahlian utama dari pelatihan ini.'),
                TextInput::make('sub_vocational_field')
                    ->label('Sub Kejuruan')
                    ->placeholder('Pilih sub kejuruan')
                    ->helperText('Pilih sub bidang yang paling sesuai dengan materi pelatihan.'),
                \Filament\Forms\Components\Radio::make('location_type')
                    ->label('Tipe Lokasi')
                    ->options([
                        'Dalam Negeri' => 'Dalam Negeri',
                        'Luar Negeri' => 'Luar Negeri',
                    ])
                    ->helperText('Tentukan lokasi tempat pelatihan diselenggarakan.')
                    ->inline(),
                TextInput::make('location')
                    ->label('Lokasi')
                    ->placeholder('Pilih lokasi daerah')
                    ->helperText('Pilih lokasi pelatihan sesuai tipe lokasi yang dipilih.'),
                DatePicker::make('start_date')
                    ->label('Tanggal mulai')
                    ->displayFormat('m/Y')
                    ->helperText('Bulan dan tahun saat pelatihan mulai dilaksanakan.')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Tanggal berakhir')
                    ->displayFormat('m/Y')
                    ->helperText('Bulan dan tahun saat pelatihan selesai.'),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (opsional)')
                    ->placeholder('Masukkan Deskripsi')
                    ->helperText('Jelaskan materi pelatihan, kompetensi yang diperoleh, atau tujuan pelatihan.')
                    ->columnSpanFull(),
                \Filament\Forms\Components\FileUpload::make('certificate_file')
                    ->label('Sertifikat pelatihan')
                    ->placeholder('Klik untuk meng-upload file kesini')
                    ->directory('trainings_certificates')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->columnSpanFull(),
            ]);
    }
}
