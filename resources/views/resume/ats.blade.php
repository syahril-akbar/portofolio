<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV ATS - {{ $profile->name }}</title>
    <style>
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            border-bottom: 1.5pt solid #000;
            padding-bottom: 10pt;
            margin-bottom: 15pt;
        }
        .header h1 {
            font-size: 18pt;
            margin: 0 0 5pt 0;
            text-transform: uppercase;
            letter-spacing: 1pt;
        }
        .contact-info {
            font-size: 9pt;
            margin-bottom: 5pt;
        }
        .contact-info span {
            margin: 0 5pt;
        }
        .section {
            margin-bottom: 12pt;
        }
        .section-title {
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 0.5pt solid #ccc;
            margin-bottom: 6pt;
            padding-bottom: 2pt;
            color: #000;
        }
        .item {
            margin-bottom: 8pt;
        }
        .item-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }
        .item-row {
            clear: both;
            width: 100%;
        }
        .item-title {
            float: left;
            font-weight: bold;
        }
        .item-date {
            float: right;
            font-style: italic;
            font-size: 9pt;
        }
        .item-subtitle {
            clear: both;
            font-style: italic;
            color: #444;
            margin-bottom: 3pt;
        }
        .item-description {
            margin-top: 2pt;
            text-align: justify;
        }
        .item-description ul {
            margin: 2pt 0;
            padding-left: 15pt;
        }
        .item-description li {
            margin-bottom: 1pt;
        }
        .skills-grid {
            width: 100%;
        }
        .skill-category {
            font-weight: bold;
            display: inline-block;
            width: 100pt;
        }
        .skill-list {
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>{{ $profile->name }}</h1>
        <div class="contact-info">
            {{ $profile->email }} 
            @if($profile->phone) <span>|</span> {{ $profile->phone }} @endif
            @if($profile->address) <span>|</span> {{ $profile->address }} @endif
        </div>
        <div class="contact-info">
            @if($profile->linkedin_url) 
                LinkedIn: {{ str_replace(['https://', 'www.'], '', $profile->linkedin_url) }}
            @endif
            @if($profile->github_url) 
                <span>|</span> GitHub: {{ str_replace(['https://', 'www.'], '', $profile->github_url) }}
            @endif
        </div>
    </div>

    @if($profile->about)
    <div class="section">
        <div class="section-title">Ringkasan Profesional</div>
        <div class="item-description">
            {!! strip_tags($profile->about) !!}
        </div>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Pengalaman Kerja</div>
        @foreach($experiences as $exp)
        <div class="item">
            <div class="item-row">
                <div class="item-title">{{ $exp->role }}</div>
                <div class="item-date">
                    {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} – 
                    {{ $exp->is_current_job ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : 'Sekarang') }}
                </div>
            </div>
            <div class="item-subtitle">{{ $exp->company }} | {{ $exp->location ?? $exp->location_type }}</div>
            <div class="item-description">
                {!! $exp->description !!}
            </div>
        </div>
        @endforeach
    </div>

    <div class="section">
        <div class="section-title">Pendidikan</div>
        @foreach($educations as $edu)
        <div class="item">
            <div class="item-row">
                <div class="item-title">{{ $edu->institution }}</div>
                <div class="item-date">
                    {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }} – 
                    {{ $edu->end_date ? \Carbon\Carbon::parse($edu->end_date)->format('Y') : 'Sekarang' }}
                </div>
            </div>
            <div class="item-subtitle">{{ $edu->degree }} - {{ $edu->field_of_study }} @if($edu->grade) | IPK: {{ $edu->grade }} @endif</div>
            @if($edu->description || $edu->activities)
            <div class="item-description">
                @if($edu->description) {!! $edu->description !!} @endif
                @if($edu->activities) <p>Aktivitas: {{ $edu->activities }}</p> @endif
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <div class="section">
        <div class="section-title">Keahlian</div>
        <table class="skills-grid">
            @foreach($skills as $category => $categorySkills)
            <tr>
                <td class="skill-category" valign="top">{{ $category }}:</td>
                <td class="skill-list" valign="top">
                    {{ $categorySkills->pluck('name')->implode(', ') }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    @if($certifications->isNotEmpty() || $trainings->isNotEmpty())
    <div class="section">
        <div class="section-title">Sertifikasi & Pelatihan</div>
        @foreach($certifications as $cert)
        <div class="item" style="margin-bottom: 3pt;">
            <strong>{{ $cert->name }}</strong> – {{ $cert->issuer }} 
            <span style="float: right; font-style: italic; font-size: 9pt;">{{ \Carbon\Carbon::parse($cert->issued_at)->translatedFormat('M Y') }}</span>
        </div>
        @endforeach
        @foreach($trainings as $training)
        <div class="item" style="margin-bottom: 3pt;">
            <strong>{{ $training->name }}</strong> – {{ $training->organizer }} 
            <span style="float: right; font-style: italic; font-size: 9pt;">{{ \Carbon\Carbon::parse($training->start_date)->translatedFormat('M Y') }}</span>
        </div>
        @endforeach
    </div>
    @endif

    @if($achievements->isNotEmpty())
    <div class="section">
        <div class="section-title">Penghargaan & Pencapaian</div>
        @foreach($achievements as $ach)
        <div class="item" style="margin-bottom: 3pt;">
            <strong>{{ $ach->title }}</strong> – {{ $ach->issuer }} 
            <span style="float: right; font-style: italic; font-size: 9pt;">{{ \Carbon\Carbon::parse($ach->date)->format('Y') }}</span>
        </div>
        @endforeach
    </div>
    @endif

    @if($languages->isNotEmpty())
    <div class="section">
        <div class="section-title">Bahasa</div>
        <div>
            @foreach($languages as $lang)
                {{ $lang->name }} ({{ $lang->proficiency }}){{ !$loop->last ? ', ' : '' }}
            @endforeach
        </div>
    </div>
    @endif

</body>
</html>
