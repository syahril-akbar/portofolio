<?php

namespace App\Filament\Resources\Education\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EducationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('degree')
                    ->label('Tingkat pendidikan')
                    ->options([
                        'Sekolah Dasar' => 'Sekolah Dasar',
                        'Sekolah Menengah Pertama' => 'Sekolah Menengah Pertama',
                        'Sekolah Menengah Atas/Kejuruan' => 'Sekolah Menengah Atas/Kejuruan',
                        'D1' => 'D1',
                        'D2' => 'D2',
                        'D3' => 'D3',
                        'D4' => 'D4',
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ])
                    ->placeholder('Pilih tingkat')
                    ->helperText('Pilih tingkat pendidikan terakhir yang pernah kamu tempuh untuk memperjelas latar belakang pendidikan kamu.')
                    ->required(),
                TextInput::make('institution')
                    ->label('Sekolah atau universitas')
                    ->placeholder('Pilih sekolah atau universitas')
                    ->helperText('Nama sekolah atau universitas membantu memperjelas riwayat pendidikan kamu.')
                    ->required(),
                TextInput::make('field_of_study')
                    ->label('Bidang Studi (Jurusan)')
                    ->placeholder('Pilih bidang studi jururan kamu')
                    ->helperText('Bidang studi memperjelas spesialisasi keilmuanmu.')
                    ->required(),
                TextInput::make('grade')
                    ->label('Nilai')
                    ->placeholder('Tambahkan , apabila desimal')
                    ->helperText('Nilai bisa memberi gambaran tambahan tentang pencapaian akademik kamu.')
                    ->numeric(),
                DatePicker::make('start_date')
                    ->label('Tahun mulai')
                    ->displayFormat('Y')
                    ->placeholder('Masukan tahun mulai')
                    ->helperText('Tahun mulai membantu menunjukkan durasi dan perjalanan pendidikan kamu.')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Tahun selesai atau perkiraan')
                    ->displayFormat('Y')
                    ->placeholder('Masukan tahun selesai')
                    ->helperText('Isi tahun selesai atau perkiraan jika pendidikan belum selesai.'),
                \Filament\Forms\Components\Radio::make('location_type')
                    ->label('Tipe Lokasi')
                    ->options([
                        'Dalam Negeri' => 'Dalam Negeri',
                        'Luar Negeri' => 'Luar Negeri',
                    ])
                    ->helperText('Pilih lokasi tempat pendidikan kamu ditempuh.')
                    ->inline(),
                TextInput::make('location')
                    ->label('Lokasi')
                    ->placeholder('Pilih lokasi daerah')
                    ->helperText('Lokasi pendidikan membantu memperjelas konteks institusi dan sistem pendidikan yang kamu jalani.'),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (opsional)')
                    ->placeholder('Tulis deskripsi pendidikan kamu')
                    ->helperText('Tambahkan penjelasan singkat tentang pendidikan kamu, seperti fokus pembelajaran atau pencapaian penting.')
                    ->columnSpanFull(),
                \Filament\Forms\Components\Textarea::make('activities')
                    ->label('Aktivitas dan kegiatan sosial (opsional)')
                    ->placeholder('Tulis aktivitas dan kegiatan sosial kamu')
                    ->helperText('Aktivitas tambahan bisa menunjukkan pengalaman non-akademik dan keterlibatan kamu di luar kelas.')
                    ->columnSpanFull(),
                \Filament\Forms\Components\FileUpload::make('certificate_file')
                    ->label('Ijazah')
                    ->placeholder('Klik untuk meng-upload file kesini')
                    ->directory('education_certificates')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->columnSpanFull(),
            ]);
    }
}
