<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Training;
use App\Models\Achievement;
use App\Models\Language;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    public function download()
    {
        $profile = Profile::first();
        if (!$profile) {
            return redirect()->back()->with('error', 'Profil belum diisi.');
        }

        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $educations = Education::orderBy('start_date', 'desc')->get();
        $skills = Skill::orderBy('proficiency', 'desc')->get()->groupBy('category');
        $certifications = Certification::orderBy('issued_at', 'desc')->get();
        $trainings = Training::orderBy('start_date', 'desc')->get();
        $achievements = Achievement::orderBy('date', 'desc')->get();
        $languages = Language::orderBy('proficiency', 'desc')->get();

        $pdf = Pdf::loadView('resume.ats', compact(
            'profile', 'experiences', 'educations', 'skills',
            'certifications', 'trainings', 'achievements', 'languages'
        ));

        $filename = 'CV_ATS_' . str_replace(' ', '_', $profile->name) . '.pdf';

        return $pdf->download($filename);
    }
}
