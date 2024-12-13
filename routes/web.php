<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminFormController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CheckboxController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Jawaban;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\JawabanController;
use Carbon\Carbon;
use Helpers\Data\StringHelper;
use Helpers\Validation\Validation;
use Illuminate\Support\Facades\Lang;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * User route section
 */
Route::get('/home', [UserController::class, 'index'])->middleware('auth')->name('user.dashboard');
Route::get('/user/hasil/{user}', [UserController::class, 'downloadHasil'])->middleware('auth')->name('user.download.laporan');

/**
 * User form route section
 */
Route::get('user/form/{jawaban}', [FormController::class, 'show'])->middleware('auth')->name('user.form.show');
Route::post('user/form', [FormController::class, 'store'])->middleware('auth')->name('user.form.store');
Route::delete('user/form/{jawaban}', [FormController::class, 'destroy'])->middleware('auth')->name('user.form.destroy');

Route::patch('user/form/update/{jawaban}', [FormController::class, 'update'])->middleware('auth')->name('user.form.update');
Route::patch('user/form/update/{jawaban}/back', [FormController::class, 'updateBack'])->middleware('auth')->name('user.form.update.back');
Route::patch('user/form/update/{jawaban}/submit', [FormController::class, 'submit'])->middleware('auth')->name('user.form.update.submit');

Route::post('user/form/save-answer/{jawaban}', [FormController::class, 'saveAnswer'])->middleware('auth')->name('user.form.save-answer');

Route::get('terimakasih-telah-mengisi', function () {
    return view('form/section-done', [
        'isAdmin' => Validation::isAdmin(auth()->user()->email),
        'user' => auth()->user(),
    ]);
})->middleware('auth')->name('user.form.finish');

Route::get('/在漫游于一个旋涡般的资本主义中我与一只戴着单片眼镜的大猩猩进行了一次奇怪的对话他能够通过解释有感知能力的棉花糖的运动来预测外太空的橡皮鸭的情感', function () {
    $jawaban = request('jawaban');
    return view('alt-form/no-jump', [
        'jawaban' => $jawaban,
        'isAdmin' => Validation::isAdmin(auth()->user()->email),
        'user' => auth()->user()
    ]);
})->name('user.form.jumper');

/**
 * Admin route section
 */
// Route::resource('admin/event', AdminEventController::class)->middleware('admin')->name('admin.event');

Route::middleware('admin')->group(function () {
    Route::resource('admin/event', AdminEventController::class)->names([
        'index' => 'admin.event.index',
        'create' => 'admin.event.create',
        'store' => 'admin.event.store',
        'show' => 'admin.event.show',
        'edit' => 'admin.event.edit',
        'update' => 'admin.event.update',
        'destroy' => 'admin.event.destroy',
    ]);
});

Route::get('admin/event/overview', [AdminEventController::class, 'overview'])->middleware('admin')->name('event.overview');
Route::get('admin/event/update-on-hold/{event}', [AdminEventController::class, 'updateOnHold'])->middleware('admin')->name('update.event.on-hold');
Route::get('admin/event/update-institution-hold/{event}', [AdminEventController::class, 'updateInstitutionHold'])->middleware('admin')->name('update.event.institution');
Route::get('admin/update-city', [AdminEventController::class, 'updateCityApi'])->middleware('admin')->name('update.city-api');
Route::get('admin/event-pdf-download/{jawaban}', [AdminEventController::class, 'eventPdfDownload'])->middleware('admin')->name('event.pdf.download');
Route::get('admin/event-pdf-generate/{jawaban}', [AdminEventController::class, 'eventPdfGenerate'])->middleware('admin')->name('event.pdf.generate');

/////////

// ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::post('/storeCheckboxes', [CheckboxController::class, 'store'])->name('storeCheckboxes');

Route::get('/', function () {
    return view('/testing/welcome');
})->middleware('guest')->name('loginPage');

Route::get('/tprofile', [ProfileController::class, 'edit'])->middleware('auth')->name('tprofile.edit');

Route::get('/tfregister', [RegisteredUserController::class, 'create'])->middleware('guest')->name('tfregister.create');

// Route::get('/home', [JawabanController::class, 'index'])->name('jawaban.index');


require __DIR__ . '/auth.php';
{{  }}