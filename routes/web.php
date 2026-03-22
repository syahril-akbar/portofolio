<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PortfolioController;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/download-cv', [\App\Http\Controllers\ResumeController::class, 'download'])->name('resume.download');
