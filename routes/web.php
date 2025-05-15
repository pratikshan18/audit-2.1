<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuditOrganizationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Project;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProcessTemplateController;
// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

//---Login Form 
Route::get('/login_new', [LoginController::class, 'loginForm'])->name('login.form');
// Route::post('/login_action', [LoginController::class, 'login'])->name('login');
Route::post('/login_action', [LoginController::class, 'login'])->middleware('web');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/admin/dashboard', fn () => 'Admin Dashboard');
});


// Route::resource('posts', AuditOrganizationController::class);
///////User
Route::get('audit_all_users', [UserController::class, 'audit_all_users'])->name('audit_all_users'); // Show all organization

////for organization
Route::get('organization', [AuditOrganizationController::class, 'index'])->name('organization.index'); // Show all organization
Route::get('organization/create', [AuditOrganizationController::class, 'create'])->name('organization.create'); // Show form for creating a new post
Route::post('organization/store', [AuditOrganizationController::class, 'store'])->name('organization.store');

// Route::post('organization', [AuditOrganizationController::class, 'store'])->name('organization.store'); // Store a new post
Route::get('organization/{audit_orgnizations}', [AuditOrganizationController::class, 'show'])->name('organization.show'); // Show a single post
Route::get('organization/{audit_orgnizations}/edit', [AuditOrganizationController::class, 'edit'])->name('organization.edit'); // Show form for editing a post
Route::put('organization/{audit_orgnizations}', [AuditOrganizationController::class, 'update'])->name('organization.update'); // Update a post
Route::delete('organization/{audit_orgnizations}', [AuditOrganizationController::class, 'destroy'])->name('organization.destroy'); // Delete a post

//////WordReportPlanning
Route::get('getWordReportPlanning', [Project::class, 'getWordReportPlanning'])->name('getWordReportPlanning'); 
Route::get('getMasterWordReportPlanning', [Project::class, 'getMasterWordReportPlanning'])->name('getMasterWordReportPlanning'); 
Route::get('getBMRList_planning', [Project::class, 'getBMRList_planning'])->name('getBMRList_planning'); 
Route::post('add_template_stages', [ProcessTemplateController::class, 'add_template_stages'])->name('add_template_stages'); 
Route::post('changeStatus_planning', [Project::class, 'changeStatus_planning'])->name('changeStatus_planning'); 
Route::post('getTemplateMapChildProcess', [ServiceController::class, 'getTemplateMapChildProcess'])->name('getTemplateMapChildProcess'); 

//---For Admin Route
Route::get('AdminList', [AdminController::class, 'index'])->name('admin.admin_list'); 
Route::get('AdminCreate', [AdminController::class, 'create_admin'])->name('admin.create_admin'); 
Route::post('storeAdmin', [AdminController::class, 'save_admin_data'])->name('admin.store_admin'); 
Route::get('admin_edit/{id}', [AdminController::class, 'admin_adit'])->name('admin.edit'); 
Route::post('admin_update/{id}', [AdminController::class, 'update_admin'])->name('admin.update'); 
Route::delete('admin_delete/{id}', [AdminController::class, 'delete_admin_user'])->name('admin.delete');

Route::get('/', function () {
    return 'Laravel is working!';
});

require __DIR__.'/auth.php';


