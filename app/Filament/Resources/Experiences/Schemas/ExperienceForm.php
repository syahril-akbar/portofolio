<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('role')
                    ->label('Pekerjaan')
                    ->placeholder('Ketik pekerjaan')
                    ->helperText('Isi pekerjaan sesuai pengalaman kerjamu. Data ini membantu menggambarkan peran dan lingkungan kerja yang pernah kamu jalani.')
                    ->required(),
                TextInput::make('company')
                    ->label('Nama perusahaan')
                    ->placeholder('Ketik perusahaan')
                    ->helperText('Isi nama perusahaan sesuai pengalaman kerjamu. Data ini membantu menggambarkan peran dan lingkungan kerja yang pernah kamu jalani.')
                    ->required(),
                \Filament\Forms\Components\Select::make('employment_type')
                    ->label('Tipe Pekerjaan')
                    ->placeholder('Pilih tipe pekerjaan')
                    ->options([
                        'Penuh Waktu' => 'Penuh Waktu',
                        'Paruh Waktu' => 'Paruh Waktu',
                        'Wiraswasta' => 'Wiraswasta',
                        'Freelance' => 'Freelance',
                        'Kontrak' => 'Kontrak',
                        'Magang' => 'Magang',
                        'Musiman' => 'Musiman',
                    ])
                    ->helperText('Pilih tipe pekerjaan untuk memberikan gambaran bentuk dan sifat hubungan kerjamu.'),
                \Filament\Forms\Components\Radio::make('location_type')
                    ->label('Tipe Lokasi')
                    ->options([
                        'Dalam Negeri' => 'Dalam Negeri',
                        'Luar Negeri' => 'Luar Negeri',
                    ])
                    ->inline(),
                TextInput::make('location')
                    ->label('Lokasi')
                    ->placeholder('Pilih lokasi daerah')
                    ->helperText('Tentukan lokasi kerja, baik dalam negeri maupun luar negeri, agar pengalamanmu tercatat dengan akurat.'),
                DatePicker::make('start_date')
                    ->label('Tanggal mulai')
                    ->displayFormat('m/Y')
                    ->helperText('Isi bulan dan tahun saat kamu mulai bekerja pada pekerjaan ini.')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Tanggal berakhir')
                    ->displayFormat('m/Y')
                    ->helperText('Isi bulan dan tahun berakhirnya pekerjaan. Jika masih bekerja hingga sekarang, kamu bisa menandai sebagai pekerjaan saat ini.')
                    ->disabled(fn ($get) => $get('is_current_job')),
                \Filament\Forms\Components\Checkbox::make('is_current_job')
                    ->label('Saat ini saya bekerja dalam pekerjaan ini')
                    ->live(),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (opsional)')
                    ->placeholder('Masukkan Deskripsi')
                    ->helperText('Gunakan bagian ini untuk menjelaskan tanggung jawab utama, pencapaian, atau hal penting lain dari pekerjaan tersebut.')
                    ->columnSpanFull(),
                \Filament\Forms\Components\FileUpload::make('proof_file')
                    ->label('Bukti riwayat pekerjaan')
                    ->directory('experiences_proofs')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->columnSpanFull(),
            ]);
    }
}
