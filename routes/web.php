<?php

use App\Livewire\Admin\Dashboard\DashboardIndex;
use App\Livewire\Admin\Reports\ReportUsers;
use App\Livewire\Admin\RolesPermissions\RolePermisssionsCreate;
use App\Livewire\Admin\RolesPermissions\RolePermisssionsEdit;
use App\Livewire\Admin\RolesPermissions\RolesPermissionsIndex;
use App\Livewire\Admin\Settings\SettingsIndex;
use App\Livewire\Admin\Users\UserCreate;
use App\Livewire\Admin\Users\UserEdit;
use App\Livewire\Admin\Users\UsersIndex;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware(['auth', 'verified', 'user_active'])->group(function (): void {
    // Dashboard
    Route::get('/dashboard', DashboardIndex::class)->name('admin.dashboard')->middleware('permission:dashboard.ver');

    // Usuarios
    Route::get('/users', UsersIndex::class)->name('admin.users.index')->middleware('permission:usuario.ver');
    Route::get('/users/create', UserCreate::class)->name('admin.users.create')->middleware('permission:usuario.crear');
    Route::get('/users/edit/{user}', UserEdit::class)->name('admin.users.edit')->middleware('permission:usuario.editar');

    // Roles y Permisos
    Route::get('/roles', RolesPermissionsIndex::class)->name('admin.roles.index')->middleware('permission:rol.ver');
    Route::get('/roles/create', RolePermisssionsCreate::class)->name('admin.roles.create')->middleware('permission:rol.crear');
    Route::get('/roles/edit/{role}', RolePermisssionsEdit::class)->name('admin.roles.edit')->middleware('permission:rol.editar');

    // Reportes
    Route::get('/reports/users', ReportUsers::class)->name('admin.reports.users')->middleware('permission:reportes.ver');

    // Configuración
    Route::get('/settings/general', SettingsIndex::class)->name('admin.settings.general')->middleware('permission:dashboard.ver');
});

Route::middleware(['auth'])->group(function (): void {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
