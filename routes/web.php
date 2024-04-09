<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
// Create
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
// Read
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
// Update
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
// Delete
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Inquiries
Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
// Create an inquiry through the contact page
Route::get('/contact', [InquiryController::class, 'create'])->name('contact');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
// Read
Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
// Update
Route::get('/inquiries/{inquiry}/edit', [InquiryController::class, 'edit'])->name('inquiries.edit');
Route::put('/inquiries/{inquiry}', [InquiryController::class, 'update'])->name('inquiries.update');
// Delete
Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
