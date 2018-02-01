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

Route::get('/', function () {
    return view('welcome');
});
Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
// Password reset link request routes...
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('disconnect', 'AuthController@disconnect');
//Route::post('register', 'AuthController@register');
// Password reset routes...
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
//Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');
Route::post('/password/reset', 'Auth\PasswordController@reset')->name('password.reset');
Route::post('map/position', 'mapController@position')->name('map.send');;
Route::post('med/addMed', 'medController@addMed');
Route::post('per/addPer', 'perController@addPer');
Route::get('map/getposition', 'mapController@getposition')->name('map.request');
Route::get('med/getmed', 'medController@getmed')->name('med.request');
Route::post('adv/addadvice', 'advController@addadvice');
Route::get('adv/getadvice', 'advController@getadvice')->name('adv.request');
Route::post('symp/addSymp', 'SymptomesController@addSymp');
Route::get('symp/getsymp', 'SymptomesController@getsymp')->name('symp.request');
Route::post('symp/updatesymp', 'SymptomesController@updatesymp')->name('symp.request1');
Route::post('BP/addBP', 'BestPracticesController@addBP');
Route::get('BP/getBP', 'BestPracticesController@getBP')->name('BP.request');
Route::post('BP/updateBP', 'BestPracticesController@updateBP')->name('BP.request1');