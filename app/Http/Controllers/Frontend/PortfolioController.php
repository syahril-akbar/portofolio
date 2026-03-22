<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Training;
use App\Models\Achievement;
use App\Models\Language;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $projects = Project::where('is_published', true)->orderBy('created_at', 'desc')->get();
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $educations = Education::orderBy('start_date', 'desc')->get();
        
        // Group skills by category
        $skills = Skill::orderBy('proficiency', 'desc')->get()->groupBy('category');
        
        $certifications = Certification::orderBy('issued_at', 'desc')->get();
        $trainings = Training::orderBy('start_date', 'desc')->get();
        $achievements = Achievement::orderBy('date', 'desc')->get();
        $languages = Language::orderBy('proficiency', 'desc')->get();

        return view('frontend.index', compact(
            'profile', 'projects', 'experiences', 'educations', 'skills',
            'certifications', 'trainings', 'achievements', 'languages'
        ));
    }
}
