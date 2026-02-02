<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BacentaController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Client-facing website)
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [PublicController::class, 'home'])->name('home');

// About pages
Route::prefix('a-propos')->name('about.')->group(function () {
    Route::get('/histoire', [PublicController::class, 'history'])->name('history');
    Route::get('/vision', [PublicController::class, 'vision'])->name('vision');
    Route::get('/leadership', [PublicController::class, 'leadership'])->name('leadership');
    Route::get('/croyances', [PublicController::class, 'beliefs'])->name('beliefs');
});

// Ministries pages
Route::prefix('ministeres')->name('ministries.')->group(function () {
    Route::get('/louange', [PublicController::class, 'ministryWorship'])->name('worship');
    Route::get('/jeunesse', [PublicController::class, 'ministryYouth'])->name('youth');
    Route::get('/enfants', [PublicController::class, 'ministryChildren'])->name('children');
    Route::get('/femmes', [PublicController::class, 'ministryWomen'])->name('women');
    Route::get('/hommes', [PublicController::class, 'ministryMen'])->name('men');
});

// Testimonials
Route::get('/temoignages', [PublicController::class, 'testimonials'])->name('testimonials');
Route::get('/temoignages/{testimonial}', [PublicController::class, 'testimonialShow'])->name('testimonials.show');

// Events
Route::get('/evenements', [PublicController::class, 'events'])->name('events');
Route::get('/evenements/{slug}', [PublicController::class, 'eventShow'])->name('events.show');

// Sermons
Route::get('/predications', [PublicController::class, 'sermons'])->name('sermons');
Route::get('/predications/{slug}', [PublicController::class, 'sermonShow'])->name('sermons.show');

// Give/Donate
Route::get('/donner', [PublicController::class, 'give'])->name('give');

// Contact
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'contactSubmit'])->name('contact.submit');

// Legal pages
Route::get('/politique-de-confidentialite', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/conditions-utilisation', [PublicController::class, 'terms'])->name('terms');

// Language switcher
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, config('app.available_locales', ['fr', 'en']))) {
        session(['locale' => $locale]);
        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }
    }
    return back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', \App\Http\Middleware\SetLocale::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::get('/password', [ProfileController::class, 'password'])->name('password');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    });

    // Members
    Route::get('/members/archived', [MemberController::class, 'archived'])->name('members.archived');
    Route::post('/members/{id}/restore', [MemberController::class, 'restore'])->name('members.restore');
    Route::resource('members', MemberController::class);
    Route::post('/members/{member}/toggle-status', [MemberController::class, 'toggleStatus'])->name('members.toggle-status');

    // Structures - Branches
    Route::resource('branches', BranchController::class);

    // Structures - Zones
    Route::get('/zones/archived', [ZoneController::class, 'archived'])->name('zones.archived');
    Route::post('/zones/{id}/restore', [ZoneController::class, 'restore'])->name('zones.restore');
    Route::resource('zones', ZoneController::class);

    // Structures - Bacentas
    Route::resource('bacentas', BacentaController::class);
    Route::get('/bacentas/{bacenta}/members', [BacentaController::class, 'members'])->name('bacentas.members');
    Route::post('/bacentas/{bacenta}/members', [BacentaController::class, 'addMember'])->name('bacentas.members.add');
    Route::delete('/bacentas/{bacenta}/members/{user}', [BacentaController::class, 'removeMember'])->name('bacentas.members.remove');

    // Structures - Departments
    Route::resource('departments', DepartmentController::class);
    Route::get('/departments/{department}/members', [DepartmentController::class, 'members'])->name('departments.members');
    Route::post('/departments/{department}/members', [DepartmentController::class, 'addMember'])->name('departments.members.add');
    Route::delete('/departments/{department}/members/{user}', [DepartmentController::class, 'removeMember'])->name('departments.members.remove');

    // Reports
    Route::resource('reports', ReportController::class);
    Route::get('/reports-weekly', [ReportController::class, 'weeklyByZone'])->name('reports.weekly');
    Route::get('/reports-monthly', [ReportController::class, 'monthly'])->name('reports.monthly');

    // Finances
    Route::get('/finances/incomes', [FinanceController::class, 'incomes'])->name('finances.incomes');
    Route::get('/finances/expenses', [FinanceController::class, 'expenses'])->name('finances.expenses');
    Route::get('/finances/create-expense', [FinanceController::class, 'createExpense'])->name('finances.create-expense');
    Route::resource('finances', FinanceController::class);
    Route::get('/my-donations', [FinanceController::class, 'myDonations'])->name('finances.my-donations');
    Route::get('/finances-annual', [FinanceController::class, 'annualReport'])->name('finances.annual');
    Route::get('/finances-zones', [FinanceController::class, 'zoneReport'])->name('finances.zones');

    // Events (Admin)
    Route::prefix('admin/events')->name('admin.events.')->group(function () {
        Route::get('/archived', [EventController::class, 'archived'])->name('archived');
        Route::post('/{id}/restore', [EventController::class, 'restore'])->name('restore');
        Route::patch('/{event}/toggle-publish', [EventController::class, 'togglePublish'])->name('toggle-publish');
        Route::patch('/{event}/toggle-featured', [EventController::class, 'toggleFeatured'])->name('toggle-featured');
    });
    Route::resource('admin/events', EventController::class)->names('admin.events');

    // Schedules (Admin)
    Route::prefix('admin/schedules')->name('admin.schedules.')->group(function () {
        Route::patch('/{schedule}/toggle-active', [ScheduleController::class, 'toggleActive'])->name('toggle-active');
    });
    Route::resource('admin/schedules', ScheduleController::class)->names('admin.schedules')->except(['show']);

    // Testimonials (Admin)
    Route::prefix('admin/testimonials')->name('admin.testimonials.')->group(function () {
        Route::patch('/{testimonial}/toggle-active', [TestimonialController::class, 'toggleActive'])->name('toggle-active');
        Route::patch('/{testimonial}/toggle-featured', [TestimonialController::class, 'toggleFeatured'])->name('toggle-featured');
    });
    Route::resource('admin/testimonials', TestimonialController::class)->names('admin.testimonials');
});
