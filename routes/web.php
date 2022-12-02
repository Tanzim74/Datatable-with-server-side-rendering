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

Route::get('/subquery','QueryController@sub');
Route::get('/q5','QueryController@question_5');
Route::get('/q6','QueryController@question_6');
Route::get('/q8','QueryController@question_8');
Route::get('/q9','QueryController@question_9');
Route::get('/q10','QueryController@question_10');
Route::get('/datatable','QueryController@datatable');
Route::get('/get_next_data','QueryController@get_next_data')->name('get_next_data');
