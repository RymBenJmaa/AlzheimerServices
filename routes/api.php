<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::post('position', 'mapController@position');
Route::get('getposition', 'mapController@getposition');
Route::post('insertHome', 'HomeController@insertHome');
Route::get('getHome', 'HomeController@getHome');
Route::post('signup', 'AuthController@signup');
Route::get('getper', 'perController@getper');
Route::get('disconnect', 'AuthController@disconnect');

Route::get('getmed', 'medController@getmed');
Route::post('addMed', 'medController@addMed');
Route::post('addadvice', 'advController@addadvice');
Route::get('getadvice', 'advController@getadvice');
Route::post('addPer', 'perController@addPer');
Route::post('addSymp', 'SymptomesController@addSymp');
Route::get('getsymp', 'SymptomesController@getsymp');
Route::post('updatesymp', 'SymptomesController@updatesymp');
Route::post('addBP', 'BestPracticesController@addBP');
Route::get('getBP', 'BestPracticesController@getBP');
Route::post('updateBP', 'BestPracticesController@updateBP');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
    });
});
