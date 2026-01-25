<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BacentaController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

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
    Route::resource('members', MemberController::class);
    Route::post('/members/{member}/toggle-status', [MemberController::class, 'toggleStatus'])->name('members.toggle-status');

    // Structures - Branches
    Route::resource('branches', BranchController::class);

    // Structures - Zones
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
    Route::resource('finances', FinanceController::class);
    Route::get('/my-donations', [FinanceController::class, 'myDonations'])->name('finances.my-donations');
    Route::get('/finances-annual', [FinanceController::class, 'annualReport'])->name('finances.annual');
    Route::get('/finances-zones', [FinanceController::class, 'zoneReport'])->name('finances.zones');
});
