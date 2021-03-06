<?php

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
Route::get('/', 'HomeController@index')->name('login');
Route::get('/register', 'HomeController@register')->name('register');

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get ('/redirect/{service}', 'socialController@redirect');
Route::get ('/callback/{service}', 'socialController@callback');



Auth::routes();

 Route::get('/home', 'HomeController@home')->name('home');
//after scan QR code
Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration');

Route::post('/2fa', function () {
    return redirect(URL()->previous());
})->name('2fa')->middleware('2fa');





// pages

Route::get('/ledger', 'LedgerController@index')->name('ledgerUrl');



