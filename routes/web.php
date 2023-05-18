<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ManualPaymentController;
use App\Http\Controllers\OnlinePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('departments', DepartmentController::class);
        Route::resource('participants', ParticipantController::class);
        Route::resource('programs', ProgramController::class);
        Route::resource('announcements', AnnouncementController::class);
        Route::resource('checks', CheckController::class);
        Route::resource('counters', CounterController::class);
        Route::resource('feedbacks', FeedbackController::class);
        Route::resource('manual-payments', ManualPaymentController::class);
        Route::resource('users', UserController::class);
        Route::resource('transactions', TransactionController::class);
        Route::resource('stations', StationController::class);
        Route::get('all-staff', [StaffController::class, 'index'])->name(
            'all-staff.index'
        );
        Route::post('all-staff', [StaffController::class, 'store'])->name(
            'all-staff.store'
        );
        Route::get('all-staff/create', [
            StaffController::class,
            'create',
        ])->name('all-staff.create');
        Route::get('all-staff/{staff}', [StaffController::class, 'show'])->name(
            'all-staff.show'
        );
        Route::get('all-staff/{staff}/edit', [
            StaffController::class,
            'edit',
        ])->name('all-staff.edit');
        Route::put('all-staff/{staff}', [
            StaffController::class,
            'update',
        ])->name('all-staff.update');
        Route::delete('all-staff/{staff}', [
            StaffController::class,
            'destroy',
        ])->name('all-staff.destroy');

        Route::resource('organizers', OrganizerController::class);
        Route::resource('online-payments', OnlinePaymentController::class);
    });
