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

use App\Models\MakeYear;
use App\Models\Model;

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/dropdowns', function() {
    return view('components/dropdowns');
});

Route::get('makeyears/{make_id}', function ($make_id) {
    $years = MakeYear::where('make_id', $make_id)
        ->select('id as value', 'year as text')
        ->orderBy('year', 'DESC')
        ->get()
        ->toArray();
    array_unshift($years, ['value' => '', 'text' => 'Select value']);
    return $years;
});
Route::get('models/{makeyear_id}', function ($makeyear_id) {
    $models = Model::where('makeyear_id', $makeyear_id)
        ->select('id as value', 'name as text')
        ->orderBy('name', 'ASC')
        ->get()
        ->toArray();
    array_unshift($models, ['value' => '', 'text' => 'Select value']);
    return $models;
});
