<?php

use Illuminate\Support\Facades\Route;

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
	if (! auth()->check()) {
		return redirect()
					->route('login');

	}else{
		return view('welcome');
	}
    
});

Route::middleware('web')
	->prefix(config('formbuilder.url_path', '/form-builder'))
	->namespace('jazmy\FormBuilder\Controllers')
	->name('formbuilder::')
	->group(function () {
		Route::redirect('/', url(config('formbuilder.url_path', '/form-builder').'/forms'));

		/**
		 * Public form url
		 */
		Route::get('/form/{identifier}', 'RenderFormController@render')->name('form.render');
		Route::post('/form/{identifier}', 'RenderFormController@submit')->name('form.submit');
		Route::get('/form/{identifier}/feedback', 'RenderFormController@feedback')->name('form.feedback');

		/**
		 * My submission routes
		 */
		Route::resource('/my-submissions', 'MySubmissionController');
		
		/**
		 * Form submission management routes
		 */
		Route::name('forms.')
			->prefix('/forms/{fid}')
			->group(function () {
				Route::resource('/submissions', 'SubmissionController');
			});

		/**
		 * Form management routes
		 */
		Route::resource('/forms', 'FormController');
	});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::get('/dashboard', [App\Http\Controllers\adminController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/admins', [App\Http\Controllers\adminController::class, 'admin'])->middleware('auth')->name('admin');

Route::post('/admin/create', [App\Http\Controllers\adminController::class, 'adminCreate'])->name('admin.create');

Route::get('/users/list', [App\Http\Controllers\adminController::class, 'getUsers'])->middleware('auth')->name('users.list');

Route::get('/operateurs', [App\Http\Controllers\adminController::class, 'operateur'])->middleware('auth')->name('operateur');

Route::post('/operateur/create', [App\Http\Controllers\adminController::class, 'operateurCreate'])->name('operateur.create');

Route::get('/operateurs/list', [App\Http\Controllers\adminController::class, 'getOperateurs'])->middleware('auth')->name('operateurs.list');

Route::get('/operateur/delete/{id}', [App\Http\Controllers\adminController::class, 'operateurDelete'])->name('operateur.delete');

Route::get('/admin/delete/{id}', [App\Http\Controllers\adminController::class, 'adminDelete'])->name('admin.delete');

Route::get('/admin/find/{id}', [App\Http\Controllers\adminController::class, 'findAdmin'])->name('admin.find');

Route::post('/admin/update/{id}', [App\Http\Controllers\adminController::class, 'adminUpdate'])->name('admin.update');

Route::get('/operateur/find/{id}', [App\Http\Controllers\adminController::class, 'findOperateur'])->name('operateur.find');

Route::post('/operateur/update/{id}', [App\Http\Controllers\adminController::class, 'operateurUpdate'])->name('operateur.update');

Route::get('/profile', [App\Http\Controllers\adminController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('/parametres/{id}', [App\Http\Controllers\adminController::class, 'parametreUpdate'])->middleware('auth')->name('parametres');

Route::get('/parametres', [App\Http\Controllers\adminController::class, 'parametres'])->middleware('auth')->name('parametres.page');


Route::post('/user/update/{id}', [App\Http\Controllers\adminController::class, 'userUpdate'])->name('user.update');

Route::get('change-password', [App\Http\Controllers\adminController::class, 'passwordView']);
Route::post('change-password', [App\Http\Controllers\adminController::class, 'store'])->name('change.password');



Route::post('/createform', [App\Http\Controllers\adminController::class, 'FormCreate'])->name('form.create');
//Route::post('/createficheform', [App\Http\Controllers\adminController::class, 'storeFiche'])->name('forms.store');


Route::post('/createformhistoric', [App\Http\Controllers\adminController::class, 'FormUpdate'])->name('form.update');
Route::get('/forms/{id}', [App\Http\Controllers\adminController::class, 'show'])->name('form.show');
//Route::get('/my-submissions?{id}', [App\Http\Controllers\adminController::class, 'show'])->name('form.show');
Route::get('/editform/{id}', [App\Http\Controllers\adminController::class, 'edit'])->name('form.edit');
Route::get('/historicform/{id}', [App\Http\Controllers\adminController::class, 'historic'])->name('form.historic');