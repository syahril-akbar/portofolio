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
                \Filament\Schemas\Components\Section::make('Informasi Pekerjaan')
                    ->description('Detail posisi dan perusahaan tempat Anda bekerja.')
                    ->components([
                        TextInput::make('role')
                            ->label('Pekerjaan')
                            ->placeholder('Ketik pekerjaan')
                            ->helperText('Isi pekerjaan sesuai pengalaman kerjamu.')
                            ->required(),
                        TextInput::make('company')
                            ->label('Nama perusahaan')
                            ->placeholder('Ketik perusahaan')
                            ->helperText('Isi nama perusahaan tempat Anda bekerja.')
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
                            ->helperText('Pilih status kepegawaian Anda.'),
                    ]),
                \Filament\Schemas\Components\Section::make('Lokasi & Waktu')
                    ->description('Detail lokasi dan rentang waktu masa kerja Anda.')
                    ->components([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->components([
                                \Filament\Forms\Components\Radio::make('location_type')
                                    ->label('Tipe Lokasi')
                                    ->options([
                                        'Dalam Negeri' => 'Dalam Negeri',
                                        'Luar Negeri' => 'Luar Negeri',
                                    ])
                                    ->inline(),
                                TextInput::make('location')
                                    ->label('Lokasi')
                                    ->placeholder('Pilih lokasi daerah'),
                            ]),
                        \Filament\Schemas\Components\Grid::make(3)
                            ->components([
                                DatePicker::make('start_date')
                                    ->label('Tanggal mulai')
                                    ->displayFormat('m/Y')
                                    ->required(),
                                DatePicker::make('end_date')
                                    ->label('Tanggal berakhir')
                                    ->displayFormat('m/Y')
                                    ->disabled(fn ($get) => $get('is_current_job')),
                                \Filament\Forms\Components\Checkbox::make('is_current_job')
                                    ->label('Masih Bekerja?')
                                    ->live(),
                            ]),
                    ]),
                \Filament\Schemas\Components\Section::make('Keterangan Tambahan')
                    ->description('Penjelasan rinci dan bukti pendukung pengalaman kerja.')
                    ->components([
                        \Filament\Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Pekerjaan (Opsional)')
                            ->placeholder('Jelaskan tanggung jawab utama dan pencapaian Anda...')
                            ->rows(4)
                            ->columnSpanFull(),
                        \Filament\Forms\Components\FileUpload::make('proof_file')
                            ->label('Bukti riwayat pekerjaan (PDF/Gambar)')
                            ->directory('experiences_proofs')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
