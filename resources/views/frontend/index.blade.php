@extends('layouts.frontend')

@section('content')

@if(!$profile)
<div class="flex items-center justify-center min-h-[80vh]">
    <div class="text-center space-y-4">
        <div class="w-16 h-16 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 outfit-font">Profil Belum Diisi</h2>
        <p class="text-gray-500">Silakan login ke dashboard admin untuk mengisi data profil pertama kali.</p>
        <a href="{{ url('/admin') }}" class="inline-block mt-4 px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">Pergi ke Dashboard</a>
    </div>
</div>
@else

<!-- Hero Section -->
<section id="about" class="relative pt-20 pb-24 overflow-hidden items-center flex">
    <div class="absolute inset-0 bg-gradient-to-br from-teal-50 to-white -z-10"></div>
    <div class="absolute inset-y-0 right-0 w-1/2 bg-teal-50/50 rounded-l-full -z-10 transform translate-x-1/3"></div>
    
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="md:w-3/5 space-y-6">
                <div>
                    <span class="inline-block py-1 px-3 rounded-full bg-teal-100 text-teal-700 text-sm font-semibold mb-4 tracking-wide uppercase">PORTFOLIO</span>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 outfit-font leading-tight">
                        Halo, saya <span class="text-teal-600">{{ explode(' ', trim($profile->name))[0] }}</span>.
                    </h1>
                    <h2 class="text-2xl md:text-3xl font-medium text-gray-600 mt-4 outfit-font">
                        {{ $profile->headline }}
                    </h2>
                </div>
                
                @if($profile->address || $profile->phone)
                <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-gray-500 font-medium">
                    @if($profile->phone)
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>{{ $profile->phone }}</span>
                    </div>
                    @endif
                    @if($profile->address)
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>{{ $profile->address }}</span>
                    </div>
                    @endif
                </div>
                @endif

                <div class="prose prose-lg text-gray-600 prose-a:text-teal-600">
                    {!! $profile->about !!}
                </div>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="mailto:{{ $profile->email }}" class="px-7 py-2.5 bg-teal-600 text-white rounded-lg font-medium hover:bg-teal-700 transition-all shadow-md transform hover:-translate-y-0.5 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Hubungi Saya
                    </a>
                    <a href="#projects" class="px-7 py-2.5 bg-white border border-gray-200 text-gray-900 rounded-lg font-medium hover:bg-gray-50 transition-all shadow-sm">Project</a>
                    
                    @if($profile->resume_url || $profile->resume_file)
                    <a href="{{ $profile->resume_file ? Storage::url($profile->resume_file) : $profile->resume_url }}" target="_blank" class="px-7 py-2.5 bg-gray-50 border border-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Resume
                    </a>
                    @endif
                </div>
            </div>
            
            <div class="md:w-2/5 flex justify-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-teal-400 to-emerald-300 rounded-[2rem] transform rotate-3 scale-105 -z-10"></div>
                    @if($profile->photo)
                        <img src="{{ Storage::url($profile->photo) }}" alt="{{ $profile->name }}" class="w-64 h-64 md:w-80 md:h-80 object-cover rounded-[2rem] shadow-2xl border-4 border-white">
                    @else
                        <div class="w-64 h-64 md:w-80 md:h-80 bg-gray-200 rounded-[2rem] shadow-xl flex items-center justify-center border-4 border-white text-gray-400">
                            <span class="text-sm">Tanpa Foto</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience & Education (Timeline) -->
<section id="experience" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <!-- Experience -->
            <div>
                <h3 class="text-3xl font-bold text-gray-900 outfit-font mb-10 flex items-center gap-3">
                    <span class="w-10 h-10 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center">💼</span>
                    Pengalaman
                </h3>
                @if($experiences->isEmpty())
                    <p class="text-gray-500 italic">Belum ada data pengalaman kerja.</p>
                @else
                    <div class="space-y-12">
                        @foreach($experiences as $exp)
                        <div class="relative pl-8 before:absolute before:inset-0 before:ml-[9px] before:w-0.5 before:bg-gradient-to-b before:from-teal-100 before:via-gray-200 before:to-transparent">
                            <div class="absolute left-0 w-5 h-5 bg-white border-4 border-teal-500 rounded-full mt-1.5 shadow"></div>
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex flex-wrap justify-between items-start gap-2 mb-2">
                                    <h4 class="text-xl font-bold text-gray-900">{{ $exp->role }}</h4>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} - 
                                        {{ $exp->is_current_job ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : 'Sekarang') }}
                                    </span>
                                </div>
                                <div class="text-teal-600 font-medium mb-3">
                                    {{ $exp->company }} 
                                    <span class="text-gray-400 mx-1">•</span> <span class="text-gray-500 font-normal">{{ $exp->employment_type }}</span>
                                    @if($exp->location)
                                    <span class="text-gray-400 mx-1">•</span> <span class="text-gray-500 font-normal">{{ $exp->location }} ({{ $exp->location_type ?? 'Lokal' }})</span>
                                    @endif
                                </div>
                                <div class="prose prose-sm text-gray-600 max-w-none mb-4">
                                    {!! $exp->description !!}
                                </div>
                                @if($exp->proof_file)
                                <a href="{{ Storage::url($exp->proof_file) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-medium text-teal-600 hover:text-teal-800 bg-teal-50 px-3 py-1.5 rounded-lg border border-teal-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    Lihat Bukti Pengalaman
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Education -->
            <div>
                <h3 class="text-3xl font-bold text-gray-900 outfit-font mb-10 flex items-center gap-3">
                    <span class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">🎓</span>
                    Pendidikan
                </h3>
                @if($educations->isEmpty())
                    <p class="text-gray-500 italic">Belum ada data pendidikan.</p>
                @else
                    <div class="space-y-12">
                        @foreach($educations as $edu)
                        <div class="relative pl-8 before:absolute before:inset-0 before:ml-[9px] before:w-0.5 before:bg-gradient-to-b before:from-blue-100 before:via-gray-200 before:to-transparent">
                            <div class="absolute left-0 w-5 h-5 bg-white border-4 border-blue-500 rounded-full mt-1.5 shadow"></div>
                            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex flex-wrap justify-between items-start gap-2 mb-2">
                                    <h4 class="text-xl font-bold text-gray-900">{{ $edu->institution }}</h4>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }} - 
                                        {{ $edu->end_date ? \Carbon\Carbon::parse($edu->end_date)->format('Y') : 'Sekarang' }}
                                    </span>
                                </div>
                                <div class="text-blue-600 font-medium mb-1">
                                    {{ $edu->degree }} - {{ $edu->field_of_study }}
                                    @if($edu->location)
                                    <span class="text-gray-400 font-normal mx-1">•</span> <span class="text-gray-500 font-normal">{{ $edu->location }}</span>
                                    @endif
                                </div>
                                @if($edu->grade)
                                <div class="text-sm text-gray-500 mb-3 font-medium">Nilai/IPK: <span class="text-gray-900">{{ $edu->grade }}</span></div>
                                @endif
                                <div class="prose prose-sm text-gray-600 max-w-none mb-4">
                                    {!! $edu->description !!}
                                    @if($edu->activities)
                                        <p class="text-sm mt-2"><strong>Aktivitas & Kegiatan:</strong> <br> {!! nl2br(e($edu->activities)) !!}</p>
                                    @endif
                                </div>
                                @if($edu->certificate_file)
                                <a href="{{ Storage::url($edu->certificate_file) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Lihat Ijazah
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

<!-- Projects Gallery -->
<section id="projects" class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-teal-600 font-bold uppercase tracking-wider text-sm mb-2 block">Etalase Portofolio</span>
            <h2 class="text-4xl font-bold text-gray-900 outfit-font mb-4">Proyek & Karya</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg">Beberapa proyek yang telah saya kerjakan dari awal hingga rilis.</p>
        </div>

        @if($projects->isEmpty())
            <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
                <p class="text-gray-500 italic">Belum ada proyek yang dipublikasikan.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        @if($project->start_date || $project->end_date)
                        <div class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur text-gray-800 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                            {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M Y') : 'Mulai' }} - {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M Y') : 'Sekarang' }}
                        </div>
                        @endif
                        @if($project->image)
                            <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">Tanpa Gambar</div>
                        @endif
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 outfit-font">{{ $project->title }}</h3>
                        @if($project->role)
                            <div class="text-sm text-teal-600 font-medium mb-3 flex items-center gap-1.5 border border-teal-100 bg-teal-50 w-fit px-2 py-0.5 rounded">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $project->role }}
                            </div>
                        @endif
                        <div class="prose prose-sm text-gray-500 mb-6 line-clamp-3">
                            {!! strip_tags($project->description) !!}
                        </div>
                        
                        @if(is_array($project->tech_stack) || is_object($project->tech_stack))
                        <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                            @foreach($project->tech_stack as $tech)
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-md">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                        
                        <div class="flex items-center gap-4 mt-auto pt-4 border-t border-gray-50">
                            @if($project->demo_link)
                            <a href="{{ $project->demo_link }}" target="_blank" class="text-teal-600 hover:text-teal-700 font-medium text-sm flex items-center gap-1">
                                <span>Live Demo</span> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                            @endif
                            @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" class="text-gray-600 hover:text-gray-900 font-medium text-sm flex items-center gap-1">
                                <span>Source Code</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Additional Info: Skills, Certs, Awards -->
<section id="skills" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
            
            <!-- Left Column: Skills & Languages -->
            <div class="md:col-span-5 space-y-16">
                <!-- Skills -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 outfit-font mb-6 border-b pb-2">Keahlian (Skills)</h3>
                    @if($skills->isEmpty())
                        <p class="text-gray-500 italic text-sm">Belum ada data keahlian.</p>
                    @else
                        <div class="space-y-6">
                            @foreach($skills as $category => $categorySkills)
                            <div>
                                <h4 class="text-xs font-bold tracking-wider text-gray-400 uppercase mb-3">{{ $category }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($categorySkills as $skill)
                                        <div class="group relative px-3 py-1.5 bg-gray-50 border border-gray-100 rounded-md hover:border-teal-200 hover:bg-teal-50 transition-colors cursor-default text-sm">
                                            <span class="font-medium text-gray-700 group-hover:text-teal-700">{{ $skill->name }}</span>
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:flex flex-col items-center z-10 transition-all">
                                                <div class="bg-gray-800 text-white text-[10px] py-1 px-2 rounded font-medium whitespace-nowrap shadow-lg">
                                                    {{ $skill->proficiency == 100 ? 'Sangat Mahir' : ($skill->proficiency == 75 ? 'Mahir' : ($skill->proficiency == 50 ? 'Menengah' : 'Pemula')) }}
                                                </div>
                                                <div class="w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-800"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Languages -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 outfit-font mb-6 border-b pb-2">Bahasa</h3>
                    @if($languages->isEmpty())
                        <p class="text-gray-500 italic text-sm">Belum ada data bahasa.</p>
                    @else
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($languages as $lang)
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 flex justify-between items-center">
                                <span class="font-medium text-gray-800 text-sm">{{ $lang->name }}</span>
                                <span class="text-xs text-gray-500 font-semibold bg-white px-2 py-1 rounded shadow-sm">{{ $lang->proficiency }}</span>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Certs, Trainings, Awards -->
            <div class="md:col-span-7 space-y-12">
                <!-- Certs & Trainings combined visually -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 outfit-font mb-6 border-b pb-2">Lisensi & Kursus Pelatihan</h3>
                    
                    @if($certifications->isEmpty() && $trainings->isEmpty())
                        <p class="text-gray-500 italic text-sm">Belum ada data sertifikasi atau pelatihan.</p>
                    @else
                        <div class="space-y-4">
                            <!-- Certifications -->
                            @foreach($certifications as $cert)
                            <div class="flex p-4 border border-gray-100 rounded-xl hover:shadow-md transition-shadow bg-white">
                                <div class="mr-4 flex-shrink-0 pt-1">
                                    <div class="w-10 h-10 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center text-lg shadow-sm border border-teal-100">🏆</div>
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-base font-bold text-gray-900">{{ $cert->name }}</h4>
                                    <p class="text-teal-600 font-medium text-sm mb-1">{{ $cert->issuer }}</p>
                                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500 mb-2">
                                        <span>Diterbitkan: {{ \Carbon\Carbon::parse($cert->issued_at)->translatedFormat('M Y') }}</span>
                                        @if($cert->expires_at)
                                            <span>Berakhir: {{ \Carbon\Carbon::parse($cert->expires_at)->translatedFormat('M Y') }}</span>
                                        @endif
                                        @if($cert->score)
                                            <span class="font-semibold text-gray-700 border border-gray-200 px-1.5 rounded">Skor: {{ $cert->score }}</span>
                                        @endif
                                    </div>
                                    @if($cert->file)
                                    <a href="{{ Storage::url($cert->file) }}" target="_blank" class="text-teal-600 hover:text-teal-800 text-xs font-medium inline-flex items-center gap-1">
                                        Lihat Sertifikat <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach

                            <!-- Trainings -->
                            @foreach($trainings as $training)
                            <div class="flex p-4 border border-gray-100 rounded-xl hover:shadow-md transition-shadow bg-blue-50/20">
                                <div class="mr-4 flex-shrink-0 pt-1">
                                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-lg shadow-sm border border-blue-100">📘</div>
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-base font-bold text-gray-900">{{ $training->name }}</h4>
                                    <p class="text-blue-600 font-medium text-sm mb-1">{{ $training->organizer }}</p>
                                    <div class="flex flex-wrap gap-x-3 gap-y-1 text-xs text-gray-500 mb-2">
                                        <span class="bg-gray-100 px-1.5 py-0.5 rounded">{{ $training->vocational_field }}{{ $training->sub_vocational_field ? ' - '. $training->sub_vocational_field : '' }}</span>
                                        <span class="py-0.5">{{ \Carbon\Carbon::parse($training->start_date)->translatedFormat('d M Y') }} - {{ $training->end_date ? \Carbon\Carbon::parse($training->end_date)->translatedFormat('d M Y') : 'Berjalan' }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">{!! strip_tags($training->description) !!}</p>
                                    @if($training->certificate_file)
                                    <a href="{{ Storage::url($training->certificate_file) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs font-medium inline-flex items-center gap-1">
                                        Sertifikat Pelatihan <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Achievements -->
                @if($achievements->isNotEmpty())
                <div class="mt-8">
                    <h3 class="text-2xl font-bold text-gray-900 outfit-font mb-6 border-b pb-2">Penghargaan & Prestasi</h3>
                    <div class="space-y-4">
                        @foreach($achievements as $ach)
                        <div class="flex p-4 border border-yellow-100 rounded-xl bg-gradient-to-r from-yellow-50/50 to-white hover:shadow-md transition-shadow">
                            <div class="mr-4 flex-shrink-0 pt-1">
                                <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center text-xl shadow-sm border border-yellow-200">⭐</div>
                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between items-start">
                                    <h4 class="text-base font-bold text-gray-900">{{ $ach->title }}</h4>
                                    <span class="text-xs font-semibold text-yellow-700 bg-yellow-100 px-2 py-0.5 rounded">{{ \Carbon\Carbon::parse($ach->date)->format('Y') }}</span>
                                </div>
                                <p class="text-gray-500 font-medium text-xs mb-2">{{ $ach->issuer }}</p>
                                <p class="text-sm text-gray-600">{!! strip_tags($ach->description) !!}</p>
                                @if($ach->file)
                                <a href="{{ Storage::url($ach->file) }}" target="_blank" class="mt-2 text-yellow-600 hover:text-yellow-700 text-xs font-medium inline-flex items-center gap-1">
                                    Lampiran Terkait <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
        </div>
    </div>
</section>

@endif
@endsection
