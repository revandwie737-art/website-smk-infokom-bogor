<?php

use App\Http\Controllers\Admin\AchievementController as AdminAchievementController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\BkkJobController as AdminBkkJobController;
use App\Http\Controllers\Admin\BkkPartnerController as AdminBkkPartnerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ClassMemberController as AdminClassMemberController;
use App\Http\Controllers\Admin\ClassController as AdminClassController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ExtracurricularController as AdminExtracurricularController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\GradeController as AdminGradeController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PklPartnerController as AdminPklPartnerController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Public\AchievementController;
use App\Http\Controllers\Public\AgendaController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\ExtracurricularController;
use App\Http\Controllers\Public\FacilityController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\BkkController;
use App\Http\Controllers\Public\PklController;
use App\Http\Controllers\Public\PpdbController;
use App\Http\Controllers\Public\ProgramController;
use App\Http\Controllers\Public\TeacherController;
use App\Http\Controllers\Public\VideoController;
use App\Http\Controllers\Student\AnnouncementController as StudentAnnouncementController;
use App\Http\Controllers\Student\AttendanceController as StudentAttendanceController;
use App\Http\Controllers\Student\ClassmatesController as StudentClassmatesController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\GradeController as StudentGradeController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\ScheduleController as StudentScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/program-keahlian', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/program-keahlian/{slug}', [ProgramController::class, 'show'])->name('programs.show');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/guru', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galeri/{slug}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('/video', [VideoController::class, 'index'])->name('videos.index');
Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
Route::get('/fasilitas', [FacilityController::class, 'index'])->name('facilities.index');
Route::get('/pkl', [PklController::class, 'index'])->name('pkl.index');
Route::get('/bkk', [BkkController::class, 'index'])->name('bkk.index');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::post('/ppdb', [PpdbController::class, 'store'])->name('ppdb.store');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Static pages (akademik) - simple view
Route::view('/akademik', 'public.academic')->name('academic.index');

/*
|--------------------------------------------------------------------------
| LOGIN SISWA — sengaja diberi URL pendek /login dan TIDAK ditautkan di
| mana pun pada tampilan publik (navbar/footer). Bagikan URL ini secara
| manual ke siswa (mis. lewat pengumuman resmi sekolah).
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLogin'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTH (guest)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });
    Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth')->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD (auth + role:admin,teacher)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,teacher'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    Route::resource('news', AdminNewsController::class)->except(['show']);
    Route::resource('categories', AdminCategoryController::class)->only(['index', 'store', 'destroy']);
    Route::resource('programs', AdminProgramController::class)->except(['show']);
    Route::resource('achievements', AdminAchievementController::class)->except(['show']);

    Route::resource('gallery', AdminGalleryController::class)->except(['show']);
    Route::delete('gallery-images/{image}', [AdminGalleryController::class, 'destroyImage'])->name('gallery.images.destroy');

    Route::resource('videos', AdminVideoController::class)->except(['show']);
    Route::resource('facilities', AdminFacilityController::class)->except(['show']);
    Route::resource('pkl-partners', AdminPklPartnerController::class)->except(['show']);
    Route::resource('partners', AdminPartnerController::class)->except(['show']);
    Route::resource('bkk-jobs', AdminBkkJobController::class)->except(['show']);
    Route::resource('bkk-partners', AdminBkkPartnerController::class)->except(['show']);
    Route::resource('extracurriculars', AdminExtracurricularController::class)->except(['show']);
    Route::resource('announcements', AdminAnnouncementController::class)->except(['show']);
    Route::resource('events', AdminEventController::class)->except(['show']);

    Route::resource('classes', AdminClassController::class)->except(['show']);
    Route::get('/class-members', [AdminClassMemberController::class, 'index'])->name('class-members.index');
    Route::get('/class-members/create', [AdminClassMemberController::class, 'create'])->name('class-members.create');
    Route::post('/class-members', [AdminClassMemberController::class, 'store'])->name('class-members.store');
    Route::get('/class-members/{classMember}/edit', [AdminClassMemberController::class, 'edit'])->name('class-members.edit');
    Route::put('/class-members/{classMember}', [AdminClassMemberController::class, 'update'])->name('class-members.update');
    Route::delete('/class-members/{classMember}', [AdminClassMemberController::class, 'destroy'])->name('class-members.destroy');
    Route::resource('subjects', AdminSubjectController::class)->except(['show']);
    Route::resource('schedules', AdminScheduleController::class)->except(['show']);

    Route::get('/grades', [AdminGradeController::class, 'index'])->name('grades.index');
    Route::post('/grades', [AdminGradeController::class, 'store'])->name('grades.store');

    Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AdminAttendanceController::class, 'store'])->name('attendance.store');

    Route::resource('teachers', AdminTeacherController::class)->except(['show']);

    Route::resource('students', AdminStudentController::class)->except(['show', 'destroy']);
    Route::delete('/students/{student}', [AdminStudentController::class, 'destroy'])->name('students.destroy');
    Route::post('/students/{student}/approve', [AdminStudentController::class, 'approve'])->name('students.approve');
    Route::post('/students/{student}/suspend', [AdminStudentController::class, 'suspend'])->name('students.suspend');

    Route::get('/ppdb', [AdminPpdbController::class, 'index'])->name('ppdb.index');
    Route::patch('/ppdb/{ppdbRegistration}', [AdminPpdbController::class, 'updateStatus'])->name('ppdb.update-status');
    Route::delete('/ppdb/{ppdbRegistration}', [AdminPpdbController::class, 'destroy'])->name('ppdb.destroy');

    Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
});

/*
|--------------------------------------------------------------------------
| STUDENT PORTAL
|--------------------------------------------------------------------------
*/
Route::prefix('student')->name('student.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/register', [StudentAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [StudentAuthController::class, 'register']);
    });
    Route::post('/logout', [StudentAuthController::class, 'logout'])->middleware('auth')->name('logout');

    Route::middleware(['auth', 'role:student'])->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [StudentProfileController::class, 'edit'])->name('profile');
        Route::post('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/password', [StudentProfileController::class, 'updatePassword'])->name('profile.password');
        Route::get('/schedule', [StudentScheduleController::class, 'index'])->name('schedule');
        Route::get('/grades', [StudentGradeController::class, 'index'])->name('grades');
        Route::get('/attendance', [StudentAttendanceController::class, 'index'])->name('attendance');
        Route::get('/announcements', [StudentAnnouncementController::class, 'index'])->name('announcements');
        Route::get('/classmates', [StudentClassmatesController::class, 'index'])->name('classmates');
    });
});

/*
|--------------------------------------------------------------------------
| PASSWORD RESET (Laravel bawaan, admin & student pakai form yang sama)
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = \Illuminate\Support\Facades\Password::sendResetLink($request->only('email'));

    return $status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT
        ? back()->with('success', 'Link reset password telah dikirim ke email Anda.')
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token, \Illuminate\Http\Request $request) {
    return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = \Illuminate\Support\Facades\Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill(['password' => \Illuminate\Support\Facades\Hash::make($password)])->save();
        }
    );

    return $status === \Illuminate\Support\Facades\Password::PASSWORD_RESET
        ? redirect()->route('home')->with('success', 'Password berhasil direset, silakan login.')
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
