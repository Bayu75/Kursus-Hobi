<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CourseManagerController;
use App\Http\Controllers\Admin\InstructorController as AdminInstructorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CertificateController;
use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Instructor;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/', function () {
    $categories = Category::all();
    $courses = Course::with(['category', 'instructor'])
        ->withAvg('reviews', 'rating_value')
        ->withCount('enrollments')
        ->latest()
        ->take(6)
        ->get();

    $stats = [
        'courses' => Course::count(),
        'students' => Enrollment::count(),
        'instructors' => Instructor::count(),
        'satisfaction' => 95,
    ];

    return view('welcome', compact('categories', 'courses', 'stats'));
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');

    Route::get('/payments/{enrollment}', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/{enrollment}', [PaymentController::class, 'store'])->name('payments.store');

    Route::get('/learning/{course}', [LearningController::class, 'show'])->name('learning.show');

    Route::get('/reviews/{enrollment}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/{enrollment}', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/certificates/{certificate}', [CertificateController::class, 'show'])
    ->name('certificates.show');

    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download']
    )->name('certificates.download');
    
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/verify/{enrollment}', [AdminController::class, 'verify'])->name('verify');
    Route::post('/approve/{enrollment}', [AdminController::class, 'approve'])->name('approve');
    Route::post('/reject/{enrollment}', [AdminController::class, 'reject'])->name('reject');
    Route::post('/enrollments/{enrollment}/complete', [AdminController::class, 'complete'])->name('enrollments.complete');

    Route::resource('users', AdminUserController::class)->only(['index', 'destroy']);
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('instructors', AdminInstructorController::class)->except(['show']);
    Route::resource('courses', CourseManagerController::class)->except(['show']);
    Route::post('/courses/{course}/schedules', [CourseManagerController::class, 'storeSchedule'])->name('courses.schedules.store');
    Route::delete('/schedules/{schedule}', [CourseManagerController::class, 'destroySchedule'])->name('courses.schedules.destroy');
    Route::post('/courses/{course}/materials', [CourseManagerController::class, 'storeMaterial'])->name('courses.materials.store');
    Route::delete('/materials/{material}', [CourseManagerController::class, 'destroyMaterial'])->name('courses.materials.destroy');
});
